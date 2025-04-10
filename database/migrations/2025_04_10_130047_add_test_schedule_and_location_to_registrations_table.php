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
        Schema::table('registrations', function (Blueprint $table) {
            $table->dateTime('jadwal_tes')->nullable()->after('bukti_pembayaran_path');
            $table->unsignedBigInteger('school_location_id')->nullable()->after('jadwal_tes');
            $table->foreign('school_location_id')->references('id')->on('school_locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['school_location_id']);
            $table->dropColumn(['jadwal_tes', 'school_location_id']);
        });
    }
};
