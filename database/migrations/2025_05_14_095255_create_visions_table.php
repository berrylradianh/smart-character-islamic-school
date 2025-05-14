<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionsTable extends Migration
{
    public function up()
    {
        Schema::create('visions', function (Blueprint $table) {
            $table->id();
            $table->text('vision_text')->nullable();
            $table->json('mission_items')->nullable();
            $table->text('commitment_text')->nullable();
            $table->string('poster_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visions');
    }
}
