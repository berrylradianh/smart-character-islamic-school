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
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('level_id')->nullable()->constrained('levels')->onDelete('set null')->after('no_hp_orang_tua');
        });

        $jenjangs = ['smp', 'sma', 'kuliah'];
        $levelMap = [];

        foreach ($jenjangs as $jenjang) {
            $level = DB::table('levels')->where('slug', $jenjang)->first();
            if (!$level) {
                $levelId = DB::table('levels')->insertGetId([
                    'name' => ucfirst($jenjang),
                    'slug' => $jenjang,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $levelMap[$jenjang] = $levelId;
            } else {
                $levelMap[$jenjang] = $level->id;
            }
        }

        $users = DB::table('users')->whereNotNull('jenjang')->get();
        foreach ($users as $user) {
            if (isset($levelMap[$user->jenjang])) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['level_id' => $levelMap[$user->jenjang]]);
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('jenjang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('jenjang')->nullable()->after('no_hp_orang_tua');
        });

        $users = DB::table('users')->whereNotNull('level_id')->get();
        foreach ($users as $user) {
            $level = DB::table('levels')->where('id', $user->level_id)->first();
            if ($level) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['jenjang' => $level->slug]);
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropColumn('level_id');
        });
    }
};
