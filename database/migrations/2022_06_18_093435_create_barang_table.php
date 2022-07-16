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
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id_barang', 30);
             $table->foreignId('id_kategori')
                    ->references('id_kategori')
                    ->on('kategori')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
           $table->foreignId('id_status')
                    ->references('id_status')
                    ->on('status')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('stok_barang');
            $table->string('tahun_barang');
            $table->integer('harga_barang');
            $table->string('status_barang');
            $table->string('foto_barang');
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
        Schema::dropIfExists('barang');
    }
};
