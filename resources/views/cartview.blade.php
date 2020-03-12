<style>
    .spacer{
        padding:18px
    }
    .item-title{
        font-size:1.5em;
        font-weight:600;
    }
</style>
@if(count($cart->detail) <= 0)
   <center> <b>Cart is empty</b></center>
@endif
<table class="cart-table" width="100%">
    <tbody>
        @foreach ($cart->detail as $key => $row)
            <tr>
                <td class="spacer"> <img src="{{ $row->product->image ? url($row->product->image) : url('/storage/product_image/default.jpg')}}" width="70" alt="item1" />
                </td> 
                <td><span class="item-title">{{ $row->product->name }}</span><br/>Rp {{$row->product->price}}
                </td>
                <td><button class="btn btn-danger clear btn-sm cartRemove" data-id="{{ $row->id }}"><i class="fa fa-trash" ></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    $(function(){
        changeTotalCart("{{ $cart->total->total_item ?$cart->total->total_item:0 }}");
        $("#cartTotalPrice").html("{{ $cart->total->total_price ? 'Rp '.$cart->total->total_price:'' }}");
        $(".cartRemove").click(function(){
            var id = $(this).data("id");
            axios.delete("{{ url('/cart/delete') }}"+'/'+id).then(function (response){
                toastr.clear();
                toastr.success(response.data.message, 'Success');
                $("#cartView").load(APP_URL+'/cart/loadcart');
            })
            .catch(function (error){
                toastr.clear();
                toastr.error(error.response.data.message, "Error deleting data");
            })

        })
    })
</script>