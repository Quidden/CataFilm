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
        Schema::create('user_movie_lists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');

            $table->enum('status', ['plan_to_watch', 'watching', 'completed', 'dropped']);
            $table->unsignedTinyInteger('rating')->nullable();
            $table->unsignedSmallInteger('rewatch_count')->default(0);
            $table->date('watched_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'movie_id']);
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_movie_lists');
    }
};
