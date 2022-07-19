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
        Schema::create('perawatans', function (Blueprint $table) {
            $table->bigIncrements('id_perawatan', 30);
            $table->foreignId('id_barang')
                   ->references('id_barang')
                   ->on('barang')
                   ->onUpdate('restrict')
                   ->onDelete('cascade');
          $table->foreignId('id_status')
                   ->references('id_status')
                   ->on('status')
                   ->onUpdate('restrict')
                   ->onDelete('cascade');
            $table->date('tgl_perawatan');
            $table->string('foto_perawatan');
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
        Schema::dropIfExists('perawatans');
    }
};
