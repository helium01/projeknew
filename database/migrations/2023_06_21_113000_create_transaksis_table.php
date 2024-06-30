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

        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_Transaksi');
           // $table->integer('id_Konsumen');
            $table->string('id_Jenis');
            $table->date('Tanggal');
            $table->integer('Jumlah');
            //$table->integer('Harga');
            $table->integer('Total');
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
        Schema::dropIfExists('transaksis');
    }
}
