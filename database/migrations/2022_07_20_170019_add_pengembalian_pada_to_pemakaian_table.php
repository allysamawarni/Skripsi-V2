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
        Schema::table('pemakaian', function (Blueprint $table) {
            $table->datetime('pengembalian_pada')->nullable();
            $table->bigInteger('jumlah_dikembalikan')->nullable();
            $table->datetime('diterima_pada')->nullable();
            $table->bigInteger('jumlah_diterima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemakaian', function (Blueprint $table) {
            //
        });
    }
};
