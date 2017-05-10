<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLogins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_logins', function($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('oauth_id', 255);
            $table->string('access_token', 255);
            $table->string('refresh_token', 255)->nullable();
            $table->enum('driver', ['facebook', 'twitter', 'google', 'linkedin', 'github']);
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
        Schema::dropIfExists('social_logins');
    }
}
