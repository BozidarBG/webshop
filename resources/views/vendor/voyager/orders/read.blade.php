@extends('voyager::master')

@section('page_title', 'View Order')

@section('page_header')
    <h1 class="page-title">
        <i class="glyphicon glyphicon-star"></i> Viewing Order
    </h1>

@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->

                    <h4>Order Id: {{$order->id}}</h4>
                    <p>Ordered By: {{$order->user->name}}, user id: {{$order->user_id}}</p>
                    <p>Total: {{$order->formatPrice()}}</p>
                    <p>Payment status: {{$order->payment_status == 1 ? 'Paid' : 'Unpaid'}}</p>
                    <p>Paid on: {{$order->paid ? $order->paid : 'Not paid yet'}}</p>
                    <p>Delivery Status: {{$order->deliveryStatus()}}</p>
                    {{$order->delivered ? '<p>Delivered on: '.$order->delivered.'</p>' : null}}
                    <p>Delivery Address: {{$order->city}} {{$order->post_code}}, {{$order->street}}</p>
                    <p>Contact Person: {{$order->contact}}</p>
                    <p>Contact Phone: {{$order->phone1}}{{$order->phone2 ? ', '.$order->phone2 : null}}</p>
                    <p>Email: {{$order->email}}</p>
                    <p>Comment: {{$order->comment}}</p><br>

                    <h3>Update delivery status</h3>
                    <form method="post" action="{{route('voyager.update.delivery', ['id'=>$order->id])}}">
                        @csrf
                        <div class="form-group">
                            <select name="delivery_status">
                                <option class="form-control" >Please select...</option>
                                <option class="form-control" value="0">Undelivered</option>
                                <option class="form-control" value="1">In preparation</option>
                                <option class="form-control" value="2">In transit</option>
                                <option class="form-control" value="3">Delivered</option>
                                <option class="form-control" value="4">Returned</option>
                            </select>
                            <input type="submit" value="Update" name="update">
                        </div>
                    </form>
                    <br>

                    <h4>Ordered Products</h4>
                    @php $i=1; @endphp
                    @foreach($order->carts as $cart)
                    <p>{{$i}}. {{$cart->product->code}} {{$cart->product->name}}</p>
                    <p>Ordered: {{$cart->quantity}} pcs</p>
                    <p>Price: {{$cart->formatPrice($cart->price)}}</p>
                    @php $i++; @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Delete">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')

    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
