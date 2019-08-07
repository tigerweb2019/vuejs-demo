<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();

            $table->string('title');
            $table->string('avatar')->nullable();
            $table->double('price')->nullable();
            $table->double('price_discount')->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->string('reason_reject')->nullable();
            $table->smallInteger('type')->default(0)->nullable();
            $table->string('slug')->nullable();
            $table->string('tags')->nullable();
            $table->string('file_exam')->nullable();
            $table->string('file_answer')->nullable();
            $table->integer('number_question')->default(0)->nullable();
            $table->text('answer')->nullable();
            $table->integer('count_bought')->default(0)->nullable();
            $table->integer('download')->default(0)->nullable();
            $table->smallInteger('classify');
            $table->time('time')->nullable();
            $table->integer('disable')->default(1)->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->integer('set_date_time')->nullable();
            $table->integer('set_date_time_end')->nullable();
            $table->integer('admin_show_hide')->default(1)->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('topic_id')->nullable();
            $table->unsignedInteger('seo_tool_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
