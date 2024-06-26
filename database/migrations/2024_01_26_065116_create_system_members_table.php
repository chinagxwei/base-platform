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
        Schema::create('system_members', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('enterprise_id')->index()->nullable()->comment('企业ID');
            $table->integer('role_id')->index()->nullable()->comment('角色ID');
            $table->uuid('wallet_id')->index()->nullable()->comment('企业ID');
            $table->string('nickname',128)->nullable()->comment('昵称');
            $table->string('mobile',24)->nullable()->comment('手机号码');
            $table->string('remark',128)->nullable()->comment('备注');
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
        Schema::dropIfExists('system_members');
    }
};
