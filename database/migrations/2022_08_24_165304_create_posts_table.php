<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->longText('content');
            $table->string('video_link', 400)->nullable();
            $table->unsignedBigInteger('image_gallery_id');
            $table->timestamp('published_at')->nullable();
            $table->enum('type', ["article","temoignage","evenement"]);
            $table->integer('views');
            $table->integer('like');
            $table->integer('favorite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
