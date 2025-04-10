<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('jenjang');
            $table->string('nama_anak');
            $table->string('nama_orang_tua');
            $table->string('no_hp_orang_tua');
            $table->date('tanggal_lahir')->nullable();
            $table->string('kk_path')->nullable();
            $table->string('akta_path')->nullable();
            $table->string('pasfoto_path')->nullable();
            $table->string('piagam_path')->nullable();
            $table->string('bukti_pembayaran_path');
            $table->string('ijazah_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
