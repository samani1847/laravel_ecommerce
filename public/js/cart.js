function addToCart(id){
    axios.post(APP_URL+'/cart/add_to_cart', {product_id:id}).then(function (response){
        var data= response.data.data;
        var total = data.total;
        toastr.clear();
        toastr.success(response.data.data.message, 'Success');
        changeTotalCart(total);
        
    }).catch(function (error,res){
        
        toastr.clear();
        toastr.error(error.response.data.message, "Error");
    });
}

function changeTotalCart(total){
    if(total == 0){
        $("#totalCart").html('');
        
    } else {
        $("#totalCart").html(total);
    }
}

$(function(){
    $("#cartModal").on('shown.bs.modal', function() {
        $("#cartView").load(APP_URL+'/cart/loadcart');
            });
    $(".addToCartBtn").click(function(){
        var id = $(this).data('product');

        addToCart(id);
    }) 
})