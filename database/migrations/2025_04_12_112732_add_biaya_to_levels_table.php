<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiayaToLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->decimal('biaya', 15, 2)->nullable()->after('slug');
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('biaya');
        });
    }
}
