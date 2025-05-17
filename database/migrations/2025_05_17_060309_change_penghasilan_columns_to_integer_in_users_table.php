<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePenghasilanColumnsToIntegerInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('penghasilan_ayah')->nullable()->change();
            $table->integer('penghasilan_ibu')->nullable()->change();
            $table->integer('penghasilan_ayah_wali')->nullable()->change();
            $table->integer('penghasilan_ibu_wali')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('penghasilan_ayah', 15, 2)->nullable()->change();
            $table->decimal('penghasilan_ibu', 15, 2)->nullable()->change();
            $table->decimal('penghasilan_ayah_wali', 15, 2)->nullable()->change();
            $table->decimal('penghasilan_ibu_wali', 15, 2)->nullable()->change();
        });
    }
}
