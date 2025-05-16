<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop columns yang tidak dibutuhkan
            $table->dropColumn(['nama_orang_tua', 'no_hp_orang_tua', 'ijazah_sd_path', 'ijazah_smp_path', 'ijazah_sma_path', 'piagam_path', 'kk_path', 'akta_path']);

            // Tambah kolom baru
            $table->string('nama_panggilan')->nullable();
            $table->string('nomor_induk_asal')->nullable();
            $table->string('nisn')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('status_anak')->nullable();
            $table->string('diterima_kelas')->nullable();
            $table->date('diterima_tanggal')->nullable();
            $table->string('ra_tk_asal')->nullable();
            $table->text('alamat_ra_tk')->nullable();
            $table->string('sd_mi_asal')->nullable();
            $table->text('alamat_sd_mi')->nullable();

            // Orang tua kandung
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat_ayah')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->string('telepon_ortu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->decimal('penghasilan_ayah', 15, 2)->nullable();
            $table->decimal('penghasilan_ibu', 15, 2)->nullable();

            // Orang tua wali
            $table->string('nama_ayah_wali')->nullable();
            $table->string('nama_ibu_wali')->nullable();
            $table->text('alamat_ayah_wali')->nullable();
            $table->text('alamat_ibu_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            $table->string('pekerjaan_ayah_wali')->nullable();
            $table->string('pekerjaan_ibu_wali')->nullable();
            $table->string('pendidikan_ayah_wali')->nullable();
            $table->string('pendidikan_ibu_wali')->nullable();
            $table->decimal('penghasilan_ayah_wali', 15, 2)->nullable();
            $table->decimal('penghasilan_ibu_wali', 15, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Restore dropped columns
            $table->string('nama_orang_tua')->nullable();
            $table->string('no_hp_orang_tua')->nullable();
            $table->string('kk_path')->nullable();
            $table->string('akta_path')->nullable();
            $table->string('ijazah_sd_path')->nullable();
            $table->string('ijazah_smp_path')->nullable();
            $table->string('ijazah_sma_path')->nullable();
            $table->string('piagam_path')->nullable();

            // Drop new columns
            $table->dropColumn([
                'nama_panggilan', 'nomor_induk_asal', 'nisn', 'tempat_lahir',
                'jenis_kelamin', 'agama', 'anak_ke', 'status_anak',
                'diterima_kelas', 'diterima_tanggal', 'ra_tk_asal', 'alamat_ra_tk',
                'sd_mi_asal', 'alamat_sd_mi', 'nama_ayah', 'nama_ibu',
                'alamat_ayah', 'alamat_ibu', 'telepon_ortu', 'pekerjaan_ayah',
                'pekerjaan_ibu', 'pendidikan_ayah', 'pendidikan_ibu',
                'penghasilan_ayah', 'penghasilan_ibu', 'nama_ayah_wali',
                'nama_ibu_wali', 'alamat_ayah_wali', 'alamat_ibu_wali',
                'telepon_wali', 'pekerjaan_ayah_wali', 'pekerjaan_ibu_wali',
                'pendidikan_ayah_wali', 'pendidikan_ibu_wali',
                'penghasilan_ayah_wali', 'penghasilan_ibu_wali'
            ]);
        });
    }
}
