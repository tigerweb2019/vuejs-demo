<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();

            $table->text('answer')->nullable();
            $table->text('content')->nullable();
            $table->string('answer_correct')->nullable();
            $table->integer('status')->nullable();
            $table->text('explain')->nullable();
            $table->integer('type')->nullable();
            $table->text('media')->nullable();
            $table->integer('parent_id')->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('topic_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
