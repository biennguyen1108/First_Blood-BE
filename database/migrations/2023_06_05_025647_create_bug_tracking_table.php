<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugTrackingTable extends Migration
{
    public function up()
    {
        Schema::create('bug_tracking', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bug_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('action_id');
            $table->date('tracking_date');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('bug_id')->references('id')->on('bugs');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('action_id')->references('id')->on('action');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bug_tracking');
    }
}
