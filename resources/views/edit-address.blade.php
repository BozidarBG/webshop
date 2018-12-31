@extends('layouts.layout')

@section('title')
    Address
    @endsection

    @section('content')
            <!-- checkout page -->
    <div class="privacy py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>E</span>dit Address
            </h3>

            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    <h4 class="mb-sm-4 mb-3">Change Details</h4>
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('address.update', ['id'=>$address->id])}}" method="post" class="creditly-card-form agileinfo_form">
                        @csrf
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row">
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="city" placeholder="City" required="" value="{{$address->city}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="post_code" placeholder="Post Code" required="" value="{{$address->post_code}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="street" placeholder="Address" required="" value="{{$address->street}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="contact" placeholder="Contact Person (if empty, your name will be used as contact person)" value="{{$address->contact}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="phone1" placeholder="Phone Number" required="" value="{{$address->phone1}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="phone2" placeholder="Second Phone Number (optional)" value="{{$address->phone2}}">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="email" name="email" placeholder="Email (if empty, email you signed in will be used as email)" value="{{$address->email}}">
                                    </div>
                                    <div class="controls form-group">
                                        <textarea class="billing-address-name form-control" type="text" name="comment" placeholder="Additional Comment">{{$address->comment}}</textarea>
                                    </div>
                                </div>
                                <button class="submit check_out btn">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //checkout page -->
@endsection

@section('scripts')

@endsection