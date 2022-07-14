<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->bigIncrements('id_stok');
            $table->foreignId('id_barang')->unique()
                    ->references('id_barang')
                    ->on('barang')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->integer('jumlah_stok');
            $table->text('keterangan');
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
        Schema::dropIfExists('stok');
    }
};

