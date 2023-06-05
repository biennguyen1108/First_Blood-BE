<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugAssigneesTable extends Migration
{
    public function up()
    {
        Schema::create('bug_assignees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bug_id');
            $table->unsignedInteger('user_id');
            $table->date('assigned_date');
            $table->date('resolved_date')->nullable();
            $table->timestamps();

            $table->foreign('bug_id')->references('id')->on('bugs');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bug_assignees');
    }
}
