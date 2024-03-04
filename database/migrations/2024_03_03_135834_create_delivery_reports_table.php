<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_reports', function (Blueprint $table) {
            $table->id();
            $table->date('delivery_date');
            $table->string('delivery_tracking');
            $table->string('customer_name');
            $table->string('customer_other')->nullable();
            $table->string('delivery_name');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('delivery_id');
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
        Schema::dropIfExists('delivery_reports');
    }
}
