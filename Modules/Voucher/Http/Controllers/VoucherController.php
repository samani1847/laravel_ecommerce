<?php

namespace Modules\Voucher\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Validator, Rest,Auth;
use Modules\Voucher\Entities\Voucher;
use OneStop\Cart;

class VoucherController extends Controller
{
  /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('voucher::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
       
        return view('voucher::create');
    }

    public function edit($id)
    { 
        $voucher = voucher::findOrFail($id);
        
        return view('voucher::edit', ['voucher' => $voucher]);

    }
    public function check(Request $request)
    {
        $code = $request->input("code");
        
        $voucher = Voucher::where("code",'=', $code)
                    ->where('status', '=', 1)
                    ->where('start_date', "<=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->where('end_date', ">=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereRaw('voucher.max_claim > voucher.claimed')->first();

        if($voucher){
            $cart = Cart::where("user_id", '=', Auth::id())->first();
            $cart_total = $cart->getTotal();
            
            $discount = $cart_total->total_price * $voucher->discount /100;

            $final_total = $cart_total->total_price - $discount; 
            return Rest::success("Ok", ['total'=>$final_total, 'discount' => $discount, 'name' => $voucher->name]);
        }

        return Rest::error('voucher not found');
        
    }

    public function data(Request $request){

        $result = Voucher::getDatatable($request->all());

        $data = array();
        $total = count($result);
        
        foreach ($result as $key => $value) {
            $row = array();
            $row[] = ++$key;
            $row[] = $value->name;
            $row[] = $value->code;
            $row[] = $value->discount;
            $row[] = $value->max_claim;
            $row[] = $value->claimed;
            $row[] = $value->start_date;
            $row[] = $value->end_date;
            $row[] = ($value->status == 1)? '<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>';   
            $row[] = '<button class="btn btn-warning" onClick="location.href ='."'".url('/admin/voucher/edit').'/'.$value->id."'".'"><i class="fa fa-pencil"></i> </button> 
            &nbsp;<button data-toggle="confirmation" class="btn btn-danger" id="btn-'.$value->id.'" onClick="deleteVoucher('.$value->id.')"><i class="fa fa-trash"></i></button>';
        
            $data[] = $row;

        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            "recordsFiltered"=> $total]);
    }
    
    public function update(Request $request, $id){
       
            request()->validate($this->fieldRules());
          

            $voucher = Voucher::findOrFail($id);

            $data = $request->all();
            $data['code'] = strtoupper($data['code']);
            $voucher->update($data);
        
            
            return redirect('/admin/voucher/index')
                            ->with('success','voucher updated successfully');
    }

    public function store(Request $request){
        request()->validate($this->fieldRules());
    
        $data = $request->all();
        $data['claimed'] = 0;
        $data['code'] = strtoupper($data['code']);
        Voucher::create($data);
    
        return redirect('/admin/voucher/index')
                        ->with('success','voucher created successfully');

    }

    public function get($id){
       
        try{
            $voucher = Voucher::findOrFail($id);
            
            return Rest::success('success', $voucher);

        } catch(Exception $e){
           
            return Rest::error('Error saving data');

        }
    }

    public function delete($id){
        
        try{
            $voucher = Voucher::findOrFail($id);
            $voucher->delete();
       
            return Rest::success('voucher is deleted');

        } catch(Exception $e){
           
            return Rest::error('Error deleting data');

        }
    }


    private function fieldRules(){
        return [
            'name' => 'required',
            'code' => 'required',
            'status' => 'required',
            'max_claim' => 'required|integer|min:1',
            'discount' => 'required|numeric|min:1|max:100',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }
    
}
