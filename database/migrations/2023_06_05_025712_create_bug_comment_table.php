<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugCommentTable extends Migration
{
    public function up()
    {
        Schema::create('bug_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bug_id');
            $table->string('commenter');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('bug_id')->references('id')->on('bugs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bug_comment');
    }
}
