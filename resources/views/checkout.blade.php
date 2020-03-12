@extends('layouts.basewithoutcart')



@section('content')
    <div class="row justify-content-center">
       
        @if(!count($cart))
            <div class="col-6"> 
                <div class="alert alert-danger" role="alert">
                    Cart is empty.
                </div>
            </div>
        @endif

        <div class="col-10">
        
            <h1>Checkout</h1>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th width="60%">Product</th>
                        <th class="text-center">Price</th>
                    
                        <th width="20%"> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->detail as $key => $value)
                    <tr>
                        <td class="">
                        <div class="media">
                            <a class="thumbnail pull-left" href="{{ url('/detailproduct').'/'.$value->product->id }}"> 
                            <img class="media-object img-thumbnail" src="{{ $value->product->image ? url($value->product->image) : url('/storage/product_image/default.jpg')}}" style="max-width:70px"> </a>
                            <div class="media-body" style="margin-left:30px">
                                <h4 class="media-heading"><a href="{{ url('/detailproduct').'/'.$value->product->id }}">{{ $value->product->name }}</a></h4>
                                
                            </div>
                        </div></td>
                        <td class="text-center"><strong>Rp {{$value->product->price}}</strong></td>
                        <td class="text-center">
                        <button type="button" class="btn btn-danger removecart"  data-id="{{ $value->id }}">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>
                    @endforeach
                   
                    <tr>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>Rp {{ $cart->total->total_price }}</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td><h6>Voucher Code</h6></td>
                        <td class="text-right">
                        <div class="input-group">
                            <input type="text" name="voucher" class="form-control" width="100%"/>
                            <span class="input-group-addon" id="checkVoucher">Check</span>
                            <span class="input-group-addon" id="changeVoucher" style="display:none">Change</span>
                        </div>
                        </td>
                    </tr>
                    <tr id="divdiscount" style="display:none">
                        <td>   </td>
                        <td><h6>Voucher Discount</h6></td>
                        <td class="text-right">
                            <h4><strong id="discount"></strong></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong id="finalprice">Rp {{ $cart->total->total_price }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td colspan="2">
                       <div class="row justify-content-between">
                            <div class="col-5">
                            <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-shopping-cart"></span>Pay Using Balance
                        </button>

                            </div>
                            <div class="col-2 text-center"><span style="font-size:1.5em;font-weight:bold">OR</span></div>
                            <div class="col-5 text-right">
                            <button type="button" href="{{ url('/checkout/paywithpaypal') }}" id="paypalpayment" class="btn btn-warning">
                            Pay Using Paypal 
                        </button>
                            </div>
                       </div>
                        &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        
        
    </div>


@endsection


@section('scriptfile')
    <script>
        
        $(function(){
            $(".removecart").click(function(){
                var id = $(this).data("id");
         
                axios.delete("{{ url('/cart/delete') }}"+'/'+id).then(function (response){
                    toastr.clear();
                    toastr.success(response.data.message, 'Success');
                    window.location.reload();
                })
                .catch(function (error){
                    toastr.clear();
                    toastr.error(error.response.data.message, "Error deleting data");
                })

            })
            $("#changeVoucher").click(function(){
                window.location.reload();
            })
            $("#checkVoucher").click(function(){
                var voc = $('[name="voucher"]').val();
                axios.post("{{ url('/voucher/check') }}", {code: voc}).then(function (response){
                    toastr.clear();
                    // toastr.success(response.data.message, 'Success');
                    $("#changeVoucher").show(); 
                    $("#divdiscount").show();
                    $("#checkVoucher").hide();
                    $('[name="voucher"]').prop('readonly',true);
                    $("#finalprice").html('Rp '+response.data.data.total);
                    $("#discount").html('Rp ' +response.data.data.discount);
                    

                })
                .catch(function (error){
                    toastr.clear();
                    toastr.error(error.response.data.message, "Error");
              
              
                })
            })

            $("#paypalpayment").click(function(){
                var voc = $('[name="voucher"]').val();
                axios.post("{{ url('/checkout/paywithpaypal') }}", {code: voc}).then(function (response){
                  window.location = response.data.approval_url;
                  

                })
                .catch(function (error){
                    toastr.clear();
                    toastr.error(error.response.data.error, "Error");
                
                
                })
            })

        })
    </script>
     @if ($message = Session::get('success'))
        <script>
            $(function(){
                toastr.clear();
                toastr.success('{{$message}}', 'Success');
            })
        </script>
    @elseif ($message = Session::get('error'))
        <script>
            $(function(){
                toastr.clear();
                toastr.error('{{$message}}', 'Payment Error');
            })
        </script>
    @endif
@endsection
