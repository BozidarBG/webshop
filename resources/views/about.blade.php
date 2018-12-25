@extends('layouts.layout')

@section('title')
    About Us
@endsection

@section('content')
    <div class="welcome py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>A</span>bout
                <span>U</span>s</h3>
            <!-- //tittle heading -->
            <div class="row">
                <div class="col-lg-6 welcome-left">
                {!! setting('site.about') !!}
                </div>
                <div class="col-lg-6 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
                    @php
                    $image=setting('site.about_photo') !=null ? str_replace('\\', '/', setting('site.about_photo')) : null;
                    @endphp
                    <img src="{{asset('storage/'.$image)}}" class="img-fluid" alt=" ">
                </div>
            </div>
        </div>
    </div>

    @endsection