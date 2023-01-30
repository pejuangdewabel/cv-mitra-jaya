<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropProdukIdProdukIdDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->bigInteger('produk_id_detail')->unsigned()->after('id');

            $table->foreign('produk_id_detail')
                ->references('id')
                ->on('detail_produk')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            //
        });
    }
}
