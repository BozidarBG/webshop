<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->double('total');
            $table->string('payment_status')->default(0);
            $table->string('delivery_status')->default(0);
            $table->dateTime('paid')->nullable();
            $table->dateTime('delivered')->nullable();
            $table->string('city');
            $table->string('post_code');
            $table->string('street');
            $table->string('contact');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
