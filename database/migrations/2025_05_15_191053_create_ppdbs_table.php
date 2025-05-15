<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpdbsTable extends Migration
{
    public function up()
    {
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->json('program_unggulan')->nullable();
            $table->text('jenjang_pendidikan')->nullable();
            $table->text('jadwal_pendaftaran')->nullable();
            $table->text('contact_info')->nullable();
            $table->string('image')->nullable();
            $table->json('rincian_biaya')->nullable();
            $table->json('jadwal_ppdb')->nullable();
            $table->json('dokumen_diperlukan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ppdbs');
    }
}
