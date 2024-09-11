<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReelsTable extends Migration
{
    public function up()
    {
        Schema::create('reels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->string('video_path'); // Path to video file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reels');
    }
}
