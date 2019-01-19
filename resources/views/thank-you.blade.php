@extends('layouts.layout')

@section('title')
    Thank You
@endsection



@section('content')
        <!-- checkout page -->
<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>T</span>hank
            <span>Y</span>ou
            <span>F</span>or
            <span>Y</span>our
            <span>O</span>rder
        </h3>
        <h5>You have successfully made a payment. You can check the status of your order on your <a href="{{route('profile.show')}}">profile page</a></h5>
    </div>
</div>
<!-- //checkout page -->
@endsection

@section('scripts')
    <script>
        localStorage.removeItem('webshopx');
    </script>
@endsection

