<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('answer')->nullable()->change();

            $table->integer('order_number')->default(0)->change();
        });

        $maxOrder = DB::table('faqs')->max('order_number') ?? 0;
        DB::table('faqs')->whereNull('order_number')->update(['order_number' => $maxOrder + 1]);
    }

    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('answer')->nullable(false)->change();

            $table->integer('order_number')->default(0)->change();
        });
    }
};
