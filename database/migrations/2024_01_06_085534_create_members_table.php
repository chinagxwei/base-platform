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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('wallet_id')->nullable()->comment('钱包ID');
            $table->uuid('enterprise_id')->nullable()->comment('企业ID');
            $table->tinyInteger('member_level')->unsigned()->default(0)->nullable()->comment('会员等级');
            $table->integer('order_revenue_config_id')->unsigned()->nullable()->comment('订单收益配置ID');
            $table->string('nickname',128)->nullable()->comment('昵称');
            $table->string('avatar',128)->nullable()->comment('头像');
            $table->string('remark',128)->nullable()->comment('备注');
            $table->uuid('parent_id')->index()->nullable()->comment('父会员ID');
            $table->tinyInteger('node_level')->unsigned()->default(0)->nullable()->comment('节点层级');
            $table->text('belong_agent_node')->nullable()->comment('属于代理节点');
            $table->integer('total_children')->unsigned()->default(0)->nullable()->comment('子成员数量');
            $table->string('mobile',18)->index()->nullable()->comment('联系电话');
            $table->string('promotion_sn',32)->index()->nullable()->comment('推广序列号');
            $table->string('promotion_qrcode',128)->index()->nullable()->comment('推广二维码');
            $table->tinyInteger('develop')->unsigned()->default(0)->nullable()->comment('测试会员 0否 1是');
            $table->tinyInteger('register_type')->unsigned()->default(1)->nullable()->comment('注册状态 0平台 1App 2网页 3小程序');
            $table->integer('login_at')->unsigned()->nullable();
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('会员表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
