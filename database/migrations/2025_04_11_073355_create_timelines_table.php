<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelinesTable extends Migration
{
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('date_range');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timelines');
    }
}
