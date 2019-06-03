<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable()->comment('项目id');
            $table->unsignedInteger('module_id')->nullable()->comment('模块id');
            $table->unsignedInteger('user_id')->comment('发布者用户id');
            $table->string('title')->comment('标题');
            $table->unsignedInteger('level_id')->nullable()->comment('优先级');
            $table->longText('description')->nullable()->comment('描述');
            $table->unsignedInteger('assign_id')->nullable()->comment('指派用户id');
            $table->date('due_date')->nullable()->comment('截止时间');
            $table->unsignedInteger('finish_id')->nullable()->comment('完成用户id');
            $table->dateTime('finish_datetime')->nullable()->comment('完成时间');
            $table->string('status', 10)->default('open')->comment('状态');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');;
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');;
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');;
            $table->foreign('assign_id')->references('id')->on('users');
            $table->foreign('finish_id')->references('id')->on('users');
        });

        Schema::create('task_tag', function (Blueprint $table) {
            $table->integer('task_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['task_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_tag');
    }
}
