<?php

namespace OneStop\Http\Controllers;

use Illuminate\Http\Request;
use Paypalpayment, Auth, Cache;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Modules\Voucher\Entities\Voucher;
use OneStop\Cart;
use OneStop\CartDetail;
use OneStop\Transaction;
use OneStop\TransactionDetail;

class TransactionController extends Controller
{
    
    public function index(){
        $transaction = Transaction::all();
        return view('transaction', compact('transaction'));
    }
   /*
    * Process payment with express checkout
    */
    public function paywithPaypal(Request $request)
    {

        $code = $request->input("code");
        
        $voucher = Voucher::where("code",'=', $code)
                    ->where('status', '=', 1)
                    ->where('start_date', "<=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->where('end_date', ">=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereRaw('voucher.max_claim > voucher.claimed')->first();
        $cart = Cart::where("user_id", '=', Auth::id())->with('detail.product')->first();
        $cart_total = $cart->getTotal();
        
        $total_price = $cart_total->total_price;
        $final_total = $total_price;
        $discount = 0;
        // var_dump($final_total);
        $transaction = Transaction::where('user_id','=',Auth::id())->where('status','<>','COMPLETED')->first();
        if($transaction){
            $transaction->delete();
        }
        
        $data = [
            'user_id' => Auth::id(),
            'status' => 'PENDING',
            'subtotal' => $final_total-$discount,
            'payment_method' => 1 
        ];
        if($voucher){
                
            // $discount= $voucher->discount;
            $discount = $total_price *  $voucher->discount /100;

            //save transaction
            $data['voucher_code'] =$voucher->code;
            
        
            //save voucher code to session
            // $final_total = $cart_total->total_price - $discount; 
        }
        Transaction::create($data);
        

        $discount = $this->convertUSD($discount);
        $final_total = $this->convertUSD($total_price);
        $final_total -= $discount;
        $subtotal = $this->convertUSD($total_price);
        // var_dump($final_total.'');
        // var_dump($discount);
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $shippingAddress= Paypalpayment::shippingAddress();
        $shippingAddress->setLine1("3909 Witmer Road")
            ->setLine2("Niagara Falls")
            ->setCity("Niagara Falls")
            ->setState("NY")
            ->setPostalCode("14305")
            ->setCountryCode("US")
            ->setPhone("716-298-1822")
            ->setRecipientName(Auth::user()->name);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item = array();

        $totalUSD = 0;
        foreach ($cart->detail as $key => $row) {
            
            $item[$key] = Paypalpayment::item();
            $price = $this->convertUSD($row->product->price);
            $item[$key]->setName($row->product->name)
                    ->setDescription( (strlen($row->product->description) > 20)?substr($row->product->description,0,17).'...':$row->product->description)
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setTax(0)
                    ->setPrice($price);
            $totalUSD += $price;
                   
        }
        

        if($discount){
        
            $vocitem = Paypalpayment::item();
            $vocitem->setName('Discount')
                ->setDescription($voucher->name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0)
                ->setPrice(0-$discount);
            $totalUSD -= $discount;
            $item[] = $vocitem;
        }
      

            $itemList = Paypalpayment::itemList();
        $itemList->setItems($item)
            ->setShippingAddress($shippingAddress);

        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                ->setTotal($totalUSD);

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(url("/transaction/paypalproceed"))
            ->setCancelUrl(url("/transaction/paypalcancel"));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }

        // return redirect($payment->getApprovalLink());
        return response()->json(['approval_url' => $payment->getApprovalLink()], 200);
    }

    private function convertUSD($total){

        $client = new Client(); //GuzzleHttp\Client
        if(Cache::has('currency')){
            $idr = Cache::get('currency');
        } else {
            $request = $client->request('GET', 'http://api.fixer.io/latest?base=USD');
            $result = json_decode($request->getBody()->getContents());
            
            $idr = $result->rates->IDR;
            Cache::add('currency', $idr, 360);
          
        }
       $output = $total / $idr;
   
        return round($output,2, PHP_ROUND_HALF_UP);
   
    }

    public function paypalCancel(Request $request){

        $transaction = Transaction::where('user_id','=',Auth::id())->where('status','!=','COMPLETED')->first();
        
        if($transaction){
            $transaction->delete();
        }
        $transaction = Transaction::where('user_id', '=', Auth::id())->with('detail')->get();
        
        return view('transaction', compact('transaction'))->with('error','Payment using paypal is cancelled');
   
    }

    public function paypalProceed(Request $request){

        $payment = $request->all();
        //$payer_id = Input::get('PayerID');
        $payer_id = $payment['PayerID'];
        $token = $payment['token'];
        $paymentId = $payment['paymentId'];
        $check = Transaction::where('user_id','=',Auth::id())->where('paypal_code','=',$paymentId)->first();
        
        if($check){
            return redirect('/transaction/showall')
            ->with('error','Payment using paypal is cancelled'); 
            return view('transaction')->with('error', 'Invalid Paypal Code');
        }
        
        $payment = Paypalpayment::getById($paymentId, Paypalpayment::apiContext());

        $paymentExecution = Paypalpayment::PaymentExecution()->setPayerId( $payer_id );
        
        $result = null;

        try{
            $result = $payment->execute($paymentExecution, Paypalpayment::apiContext());
           
        } catch(\Exception $e){
            return redirect('/transaction/showall')
            ->with('error','Payment using paypal is cancelled');
        }
        
        if ($result && $result->getState() == 'approved') { 
            
            $transaction = Transaction::where('user_id','=',Auth::id())->where('status','<>','COMPLETED');
            
            $this->updateTransaction($transaction, $result);

            $transactionAll = Transaction::where('user_id', '=', Auth::id())->get();
            return redirect('transaction/showall')
            ->with('success','Payment Success');
            
        }
        
        
        $transaction = Transaction::where('user_id','=',Auth::id())->first();
        if(!$transaction){
            return redirect('transaction/showall')
            ->with('success','Erro transaction');
            return view('transaction')->with('error', 'Error transaction');
        }        

       
    }


    private function updateTransaction($transaction, $paypal){
       $id= $transaction->first()->id;
       $transaction->update(['status' => 'COMPLETED', 'paypal_code' => $paypal->getId()]);
        
        $cart = Cart::where("user_id", '=', Auth::id())->with('detail.product')->first();
        
        foreach($cart->detail as $key => $row){
            $transaction_detail = TransactionDetail::create([
                'transaction_id' => $id,
                'product_id' => $row->product->id
            ]);
        }
        
        
        CartDetail::where(['cart_id' => $cart->id])->delete();
        Cart::find($cart->id)->delete();
        

    }

    public function showtransaction()
    {
        $transactionAll = Transaction::where('user_id', '=', Auth::id())->with('detail')->get();
        // return dd($transactionAll);
        return view('transaction', ['transaction' => $transactionAll])->with('success', 'Payment Success');

    }

    public function show($payment_id)
    {
       $payment = Paypalpayment::getById($payment_id, Paypalpayment::apiContext());
        
        return response()->json([$payment->toArray()], 200);
    }



    public function proceedPayment(Request $request){
        
        

    }
}
