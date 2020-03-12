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
                        <th colspan="2" width="60%">Product</th>
                        <th class="text-center">Price</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->detail as $key => $value)
                    <tr>
                        <td   colspan="2" class="">
                        <div class="media">
                            <a class="thumbnail pull-left" href="{{ url('/detailproduct').'/'.$value->product->id }}"> 
                            <img class="media-object img-thumbnail" src="{{ $value->product->image ? url($value->product->image) : url('/storage/product_image/default.jpg')}}" style="max-width:70px"> </a>
                            <div class="media-body" style="margin-left:30px">
                                <h4 class="media-heading"><a href="{{ url('/detailproduct').'/'.$value->product->id }}">{{ $value->product->name }}</a></h4>
                                
                            </div>
                        </div></td>
                        <td class="text-center"><strong>Rp {{$value->product->price}}</strong></td>
                    </tr>
                    @endforeach
                   
                    <tr>
                        <td></td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>Rp {{ $cart->total->total_price }}</strong></h5></td>
                    </tr>
                    
                    <tr id="divdiscount">
                        <td>   </td>
                        <td><h6>Voucher {{ $voucher->name }}</h6></td>
                        <td class="text-right">
                            <h4><strong id="discount">{{ $voucher->total }} </strong></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong id="finalprice">Rp {{ $cart->total->total_price }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong id="finalprice">$ {{ $total }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td colspan="2" class="text-right">
                            <a href="{{ url('/checkout/paywithpaypal') }}" class="btn btn-warning">
                            Confirm Payment Using Paypal 
                   
                        </a>
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
