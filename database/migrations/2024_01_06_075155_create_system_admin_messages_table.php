<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_admin_messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->string('title', 128)->comment('标题');
            $table->text('content')->comment('内容');
            $table->tinyInteger('weight')->unsigned()->default(1)->nullable()->comment('消息重要程度 1一般 2重要 3很重要');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('管理员消息表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_admin_messages');
    }
};
