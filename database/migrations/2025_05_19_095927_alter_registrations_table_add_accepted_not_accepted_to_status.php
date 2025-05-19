<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("ALTER TABLE registrations MODIFY status ENUM('waiting', 'decline', 'approve', 'accepted', 'not_accepted') NOT NULL DEFAULT 'waiting'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Mengembalikan ke definisi sebelumnya, tetapi perhatikan bahwa data dengan 'accepted' atau 'not_accepted' akan bermasalah
        DB::statement("ALTER TABLE registrations MODIFY status ENUM('waiting', 'decline', 'approve') NOT NULL DEFAULT 'waiting'");
    }
};
