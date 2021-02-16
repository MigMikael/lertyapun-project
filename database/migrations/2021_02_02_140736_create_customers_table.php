<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('status')->default('pending');
            $table->integer('point')->default(0);
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('citizen_card_image')->nullable();
            $table->unsignedBigInteger('drug_store_approve_image')->nullable();
            $table->unsignedBigInteger('medical_license_image')->nullable();
            $table->unsignedBigInteger('commercial_register_image')->nullable();
            $table->unsignedBigInteger('juristic_person_image')->nullable();
            $table->unsignedBigInteger('vat_register_cert_image')->nullable();

            $table->foreign('citizen_card_image')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('drug_store_approve_image')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('medical_license_image')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('commercial_register_image')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('juristic_person_image')
                ->references('id')
                ->on('images')
                ->onDelete('cascade');

            $table->foreign('vat_register_cert_image')
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
        Schema::dropIfExists('customers');
    }
}
