@extends('layouts.layout')

@section('title')
    {{$title}}
    @endsection

@section('content')

    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">

            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                {{$title}}</h3>
            <div class="row">

                <div class="agileinfo-ads-display col-lg-9">
                    <div class="wrapper">

                        @include('includes.products3InRow')

                    </div>
                </div>

                @include('includes.sidebar')
            </div>
        </div>
    </div>

    @endsection