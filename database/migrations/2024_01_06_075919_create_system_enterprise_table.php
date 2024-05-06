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
        Schema::create('system_enterprise', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name', 64)->nullable()->comment('企业名称');
            $table->string('name_en', 64)->nullable()->comment('企业英文名称');
            $table->string('registered_location', 128)->nullable()->comment('企业注册地');
            $table->string('registered_number', 128)->nullable()->comment('企业注册编号');
            $table->string('business_registration_number', 128)->nullable()->comment('企业商业登记号码');
            $table->string('registered_province', 128)->nullable()->comment('企业注册省份');
            $table->string('registered_city', 128)->nullable()->comment('企业注册城市');
            $table->string('registered_address', 128)->nullable()->comment('企业注册地址');
            $table->string('registration_time', 64)->nullable()->comment('企业注册时间');
            $table->string('business_province', 128)->nullable()->comment('企业经营省份');
            $table->string('business_city', 128)->nullable()->comment('企业经营城市');
            $table->string('business_address', 128)->nullable()->comment('企业经营地址');
            $table->string('website', 64)->nullable()->comment('企业网站');
            $table->tinyInteger('registered_category')->nullable()->comment('企业注册类型');
            $table->tinyInteger('status')->nullable()->comment('状态');
            $table->string('cir_certificate', 128)->nullable()->comment('CI证书图片');
            $table->string('br_certificate', 128)->nullable()->comment('BR证书图片');
            $table->string('equity_structure', 128)->nullable()->comment('股权架构图片');
            $table->integer('annual_turnover')->nullable()->comment('年度交易金额');
            $table->string('contacts', 128)->nullable()->comment('联系人');
            $table->string('telephone', 32)->nullable()->comment('联系电话');
            $table->text('introduce')->nullable()->comment('企业介绍');
            $table->string('logo', 32)->nullable()->comment('企业LOGO');
            $table->string('remark',128)->nullable()->comment('备注');
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
