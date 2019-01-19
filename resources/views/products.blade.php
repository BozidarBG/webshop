@extends('layouts.layout')

@section('title')
    {{$title}}
    @endsection

@section('content')
            <!-- top Products -->
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                {{$title}}</h3>
            <!-- //tittle heading -->
            <div class="row">
                <!-- left, 15 products per page, 3 products in a row, just like by-category -->

                <div class="agileinfo-ads-display col-lg-9">
                    <div class="wrapper">

                        @include('includes.products3InRow')
                        <!-- first section -->

                    </div>
                </div>
                <!-- //product left -->

                <!-- product right -->
                @include('includes.sidebar')
            </div>
        </div>
    </div>
    <!-- //top products -->
    @endsection