<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->float('total_amount');
            $table->string('status');
            $table->dateTime('order_date');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->dateTime('payment_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('slip_image_id');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('slip_image_id')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

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
