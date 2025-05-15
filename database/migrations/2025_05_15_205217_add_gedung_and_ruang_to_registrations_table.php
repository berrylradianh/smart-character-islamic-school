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
            $table->foreignId('gedung_id')->nullable()->constrained('gedungs')->onDelete('set null');
            $table->foreignId('ruang_id')->nullable()->constrained('ruangs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['gedung_id']);
            $table->dropForeign(['ruang_id']);
            $table->dropColumn(['gedung_id', 'ruang_id']);
        });
    }
};
