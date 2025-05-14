<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProgramsTableRemoveTypeAddDescription extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('title')->nullable()->change();
            $table->text('description')->after('title');
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('type')->default('point')->after('image'); // Restore type column
            $table->dropColumn('description'); // Remove description column
            $table->string('title')->nullable(false)->change(); // Revert title to required
        });
    }
}
