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
        Schema::create('member_base_information', function (Blueprint $table) {
            $table->uuid('member_id')->index()->nullable()->primary()->comment('会员ID');
            $table->tinyInteger('gender')->unsigned()->nullable()->comment('性别 0女 1男');
            $table->string('name',128)->nullable()->comment('名字');
            $table->integer('height')->unsigned()->nullable()->comment('身高');
            $table->integer('weight')->unsigned()->nullable()->comment('体重');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('live',128)->nullable()->comment('居住地');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('会员基础信息表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_base_infomation');
    }
};
