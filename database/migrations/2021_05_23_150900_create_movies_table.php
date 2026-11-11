<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('tmdb_id')->unique();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->text('overview')->nullable();
            $table->date('release_date')->nullable();
            $table->unsignedSmallInteger('runtime_minutes')->nullable();
            $table->string('poster_path')->nullable();
            $table->decimal('tmdb_vote_average', 3, 1)->nullable();
            $table->timestamp('cached_until')->nullable();

            $table->timestamps();

            $table->index('title');
            $table->index('release_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
