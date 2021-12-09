<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('track_id')->nullable();
            $table->text('description')->nullable();
            $table->string('age_restricted')->nullable();
            $table->string('release_year')->nullable();
            $table->string('season')->nullable();
            $table->string('genre')->nullable();
            $table->text('thumbnail')->nullable();
            $table->string('starring')->nullable();
            $table->string('director')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
