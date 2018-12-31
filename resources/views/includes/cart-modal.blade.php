<!-- cart modal -->
<div class="modal fade bd-example-modal-lg" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="row bg-info">

                    <div class="col-md-4 text-left text-justify">
                        Product Name
                    </div>
                    <div class="col-md-2 text-center">
                        Quantity
                    </div>
                    <div class="col-md-2 text-center">
                        Price
                    </div>
                    <div class="col-md-1 text-center">
                        Discount
                    </div>
                    <div class="col-md-2 text-center text-justify">
                        Price with discount
                    </div>
                    <div class="col-md-1 text-center">

                    </div>
                </div>
                <div id="cart_table"></div>



            </div>
            <div class="modal-footer">
                <span class="badge badge-info p-3" id="cart_total"></span>
                <a href="{{route('checkout')}}" class="btn btn-warning btn-lg text-white text-small">Go To Checkout</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
