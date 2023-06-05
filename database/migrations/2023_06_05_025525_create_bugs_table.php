<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsTable extends Migration
{
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('priority_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('reporter_by');
            $table->unsignedInteger('assigned_to');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('category_id')->references('id')->on('bug_categories');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('priority_id')->references('id')->on('priority');
            $table->foreign('reporter_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bugs');
    }
}
