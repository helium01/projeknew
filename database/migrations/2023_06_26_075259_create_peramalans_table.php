<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeramalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peramalans', function (Blueprint $table) {
            $table->id();
            $table->string('Jenis_Mukena');
            $table->string('Bulan');
            $table->string('Tahun');
            $table->string('Jumlah');
            $table->double('pe');
            $table->double('alpa');
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
        Schema::dropIfExists('peramalans');
    }
}
