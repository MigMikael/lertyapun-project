<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('price')->default(0);
            $table->integer('point')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('unit')->nullable();
            $table->unsignedBigInteger('image_id');
            $table->string('status')->default('active');
            // Todo add weight base on unit in Kg

            $table->foreign('image_id')
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
        Schema::dropIfExists('products');
    }
}
