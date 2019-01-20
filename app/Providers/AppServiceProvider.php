<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\Product;
use App\Slider;
use App\Brand;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        View::share('categories', Category::orderBy('name')->get());
        View::share('brands', Brand::orderBy('name')->get());
        View::share('sliders', Slider::all());

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
