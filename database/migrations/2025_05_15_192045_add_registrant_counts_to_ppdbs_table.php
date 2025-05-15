<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrantCountsToPpdbsTable extends Migration
{
    public function up()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->json('registrant_counts')->nullable()->after('image'); // Add registrant_counts field after image
        });
    }

    public function down()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn('registrant_counts');
        });
    }
}
