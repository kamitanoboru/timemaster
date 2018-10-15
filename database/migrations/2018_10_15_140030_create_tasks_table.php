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
$table->integer('user_id')->unsigned()->index();
$table->string('title');
$table->string('type')->default("single");
$table->date('start_date');
$table->integer('task_time')->default("20");
$table->integer('zone')->default("4");
$table->integer('task_order')->default("1");
$table->string('status',20)->default("unfinished");
$table->text('memo');
$table->timestamps();

// 外部キー制約
$table->foreign('user_id')->references('id')->on('users');

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
    }
}
