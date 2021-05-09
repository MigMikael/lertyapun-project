<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('account_no')->default('');
            $table->string('account_name')->default('');
            $table->string('bank_name')->default('');
            $table->string('branch_name')->default('');
            $table->string('status')->default('');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('bank_accounts');
    }
}
