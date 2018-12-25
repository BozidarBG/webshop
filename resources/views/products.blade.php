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

                        <!-- third section -->
                        <div class="product-sec1 product-sec2 px-sm-5 px-3">
                            <div class="row">
                                <h3 class="col-md-4 effect-bg">Summer Carnival</h3>
                                <p class="w3l-nut-middle">Get Extra 10% Off</p>
                                <div class="col-md-8 bg-right-nut">
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- //third section -->

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