@extends('layouts.layout')

@section('title')
    Profile
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
@endsection

    @section('content')
            <!-- checkout page -->
    <div class="privacy py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>Y</span>our Profile
            </h3>
            <!-- //tittle heading -->
            <div class="checkout-right">
                <h4 class="mb-sm-4 mb-3">Your previous orders:</h4>


            </div>

            <div class="checkout-right">
                <h4 class="mb-sm-4 mb-3">Delivery address(es):</h4>
                <div class="row bg-secondary text-white ">
                    <div class="col-md-3 border border-danger border-right-0 p-2">
                        Delivery Address
                    </div>
                    <div class="col-md-2 border border-danger border-right-0 p-2">
                        Contact Person
                    </div>
                    <div class="col-md-3 border border-danger border-right-0 p-2">
                        Contact Details
                    </div>
                    <div class="col-md-3 border border-danger border-right-0 p-2">
                        Comment
                    </div>
                    <div class="col-md-1 border border-danger p-2">

                    </div>
                </div>
                @forelse($addresses as $address)
                <div class="row " data-id="{{$address->id}}">
                    <div class="col-md-3 border border-danger border-top-0 border-right-0 p-2">
                        {{$address->post_code}} {{$address->city}}<br>
                        {{$address->street}}
                    </div>
                    <div class="col-md-2 border border-danger border-top-0 border-right-0 p-2">
                        {{$address->contact}}
                    </div>
                    <div class="col-md-3 border border-danger border-top-0 border-right-0 p-2">
                        {{$address->phone1}}<br>
                        {{$address->phone2}}<br>
                        {{$address->email}}
                    </div>
                    <div class="col-md-3 border border-danger border-top-0 border-right-0 p-2">
                        {{$address->comment}}
                    </div>
                    <div class="col-md-1 border border-danger border-top-0 p-2">
                        <a href="{{route('address.edit',['id'=>$address->id])}}" class="btn btn-warning btn-small" data-toggle="tooltip" data-placement="top" title="Edit this address"><i class="fas fa-edit"></i></a>
                        <a href="" data-toggle="modal" data-target="#confirm_delete" class="btn btn-danger btn-small mt-1 delete-address" data-toggle="tooltip" data-placement="top" title="Delete this address"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                    @empty
                <div class="row ">
                    <div class="col-md-12 border border-danger border-top-0 p-2">
                        You don't have any delivery addresses added.
                    </div>
                </div>
                    @endforelse


            </div>

            <div class="checkout-right mt-3">

                <a href="{{route('address.create')}}" class="btn btn-outline-primary">Add New Address</a>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="confirm_delete" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure that you want to delete this address?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger confirm_delete_modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- //checkout page -->
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.options.hideMethod = 'slideUp';
        toastr.options.closeButton = true;
        toastr.success("{{Session::get('success')}}");
        @endif


        @if(Session::has('error'))
            toastr.options.hideMethod = 'slideUp';
        toastr.options.closeButton = true;
        toastr.error("{{Session::get('error')}}");
        @endif
    </script>
    <script>
        $('.delete-address').on('click', function(){
            let row=$(this).closest('.row');
            let id=$(row).attr('data-id');
            $('#confirm_modal').modal('show');
            $('.confirm_delete_modal').on('click', function(){
                if(id) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //send ajax request
                    $.ajax({
                        url: "/address/"+id+"/delete",
                        method: 'POST',
                        dataType: 'json',
                        success: function (data) {

                            if (data == "success") {
                                $('#confirm_modal').modal('hide');
                                //remove row
                                $(row).css('background', 'red').hide('slow', function(){
                                    $(this).remove();
                                });
                            } else {
                                toastr().error('There was some error on the server');
                            }
                        }

                    });//end .ajax

                }
            });

        });
    </script>
@endsection