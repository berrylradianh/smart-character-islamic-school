<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRegistrationInfosTable extends Migration
{
    public function up()
    {
        Schema::table('registration_infos', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->foreignId('level_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('registration_infos', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropColumn('level_id');
            $table->string('level');
        });
    }
}
