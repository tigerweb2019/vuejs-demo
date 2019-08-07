<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_detail', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();

            $table->unsignedInteger('exam_id')->nullable();
            $table->unsignedInteger('question_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_detail');
    }
}
