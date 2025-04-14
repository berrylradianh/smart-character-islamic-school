<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');
            $table->dropColumn([
                'jenjang',
                'nama_anak',
                'nama_orang_tua',
                'no_hp_orang_tua',
                'tanggal_lahir',
                'kk_path',
                'akta_path',
                'pasfoto_path',
                'ijazah_path',
                'piagam_path',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('jenjang');
            $table->string('nama_anak');
            $table->string('nama_orang_tua');
            $table->string('no_hp_orang_tua');
            $table->date('tanggal_lahir')->nullable();
            $table->string('kk_path')->nullable();
            $table->string('akta_path')->nullable();
            $table->string('pasfoto_path')->nullable();
            $table->string('piagam_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
