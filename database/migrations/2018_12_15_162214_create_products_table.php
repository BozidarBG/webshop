<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->integer('brand_id')->index();
            $table->integer('tax_id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('excerpt');
            $table->text('description');
            $table->double('price')->unsigned()->default(0);
            $table->integer('quantity')->unsigned()->default(0);
            $table->double('discount')->unsigned()->default(0);
            $table->integer('bought')->default(0);
            //$table->double('stars')->default(0);
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
