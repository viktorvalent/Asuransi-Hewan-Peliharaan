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
        Schema::table('klaim_asuransi', function (Blueprint $table) {
            $table->renameColumn('nominal_klaim', 'nominal_bayar_rs');
            $table->integer('nominal_bayar_dokter')->nullable();
            $table->integer('nominal_bayar_obat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('klaim_asuransi', function (Blueprint $table) {
            //
        });
    }
};
