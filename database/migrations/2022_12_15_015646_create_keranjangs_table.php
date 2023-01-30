<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('produk_id')->unsigned();
            $table->integer('jumlah');
            $table->integer('sub_total');
            $table->text('file_desain')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('produk_id')
                ->references('id')
                ->on('produk')
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
        Schema::dropIfExists('keranjang');
    }
}
