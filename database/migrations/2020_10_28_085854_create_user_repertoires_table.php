<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRepertoiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_repertoire', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id")->index("user_repertoire_user_id");
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate("cascade")
                  ->onDelete("cascade");

            $table->unsignedBigInteger("repertoire_id")->index("user_repertoire_repertoire_id");
            $table->foreign('repertoire_id')
                  ->references('id')->on('repertoires')
                  ->onUpdate("cascade")
                  ->onDelete("cascade");

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
        Schema::dropIfExists('user_repertoires');
    }
}
