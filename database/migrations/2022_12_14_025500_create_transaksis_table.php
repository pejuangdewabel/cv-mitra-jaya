<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('karyawan_id')->unsigned();
            $table->integer('total');
            $table->integer('bayar')->default(0);
            $table->integer('kembalian')->default(0);
            $table->integer('status')->default(0);

            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('karyawan_id')
                ->references('id')
                ->on('karyawan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('transaksi');
    }
}
