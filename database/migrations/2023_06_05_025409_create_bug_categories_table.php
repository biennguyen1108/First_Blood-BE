<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('bug_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bug_categories');
    }
}
