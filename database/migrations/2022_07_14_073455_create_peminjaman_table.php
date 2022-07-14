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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id_peminjaman', 30);
            $table->foreignId('id_barang')
                ->references('id_barang')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian');
            $table->integer('jml_item');
            $table->timestamps();
        });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
