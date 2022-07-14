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
        Schema::create('pemakaian', function (Blueprint $table) {
            $table->bigIncrements('id_pemakaian', 30);
            $table->foreignId('id_user')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian');
            $table->integer('jml_item');
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
        Schema::dropIfExists('pemakaian');
    }
};
