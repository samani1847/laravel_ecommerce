
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" >
      <div id="cartView">
      ...
      </div>
    </div>
    <div class="modal-footer">
    <span class="text-danger mr-auto" id="cartTotalPrice" style="font-size:1.6em;font-weight:bold">
      </span>
      <a href="{{ url('/cart/checkout')}}" type="button" class="btn btn-primary" id="checkoutBtn">Checkout</a>
    </div>
  </div>
</div>
</div>
