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
        Schema::table('users', function (Blueprint $table) {
            $table->string('asal_smp_mts')->nullable()->after('alamat_sd_mi');
            $table->string('asal_sma_smk')->nullable()->after('asal_smp_mts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['asal_smp_mts', 'asal_sma_smk']);
        });
    }
};
