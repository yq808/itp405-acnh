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
        Schema::create('builds', function (Blueprint $table) {
            $table->id();
            $table->string('img_link');
            $table->string('creator_name');
            $table->string('creator_link');
            $table->foreignId('theme_id');
            $table->string('description', 500);
            $table->foreignId('category_id');
            $table->foreignId('user_id');
            $table->foreignId('season_id');
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
        Schema::dropIfExists('builds');
    }
};
