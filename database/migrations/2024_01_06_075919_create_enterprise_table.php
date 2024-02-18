<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('wallet_id')->nullable()->comment('钱包ID');
            $table->string('name', 64)->nullable()->comment('企业名称');
            $table->string('main_projects', 64)->nullable()->comment('主营项目');
            $table->string('contacts', 128)->nullable()->comment('联系人');
            $table->string('telephone', 32)->nullable()->comment('联系电话');
            $table->text('introduce')->nullable()->comment('企业介绍');
            $table->string('logo', 32)->nullable()->comment('企业LOGO');
            $table->integer('created_at')->unsigned()->nullable();
            $table->integer('updated_at')->unsigned()->nullable();
            $table->integer('created_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('updated_by')->index()->unsigned()->nullable()->comment('用户ID');
            $table->integer('deleted_at')->unsigned()->nullable();
            $table->comment('企业表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_enterprise');
    }
};
