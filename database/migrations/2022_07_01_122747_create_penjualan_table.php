<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->date('tanggal');
            $table->double('penjualan')->nullable();
            $table->double('ma3')->nullable();
            $table->double('error3')->nullable();
            $table->double('error^3')->nullable();
            $table->double('ape3')->nullable();
            $table->double('ma5')->nullable();
            $table->double('error5')->nullable();
            $table->double('error^5')->nullable();
            $table->double('ape5')->nullable();
            $table->double('ma7')->nullable();
            $table->double('error7')->nullable();
            $table->double('error^7')->nullable();
            $table->double('ape7')->nullable();
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
        Schema::dropIfExists('penjualan');
    }
}
