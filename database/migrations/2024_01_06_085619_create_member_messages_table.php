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
        Schema::create('member_messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->uuid('member_id')->index()->nullable()->comment('会员ID');
            $table->tinyInteger('member_level')->default(-1)->nullable()->comment('会员等级 -1全等级');
            $table->integer('system_message_id')->unsigned()->index()->nullable()->comment('系统消息ID');
            $table->string('title', 128)->comment('标题');
            $table->text('content')->comment('内容');
            $table->tinyInteger('weight')->unsigned()->default(1)->nullable()->comment('消息重要程度 1一般消息 2系统消息');
            $table->tinyInteger('read')->unsigned()->default(0)->nullable()->comment('阅读状态 0未读 1已读');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('会员消息表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_messages');
    }
};
