<?php

namespace App\Models\Build\SystemBuild;

trait SystemAdminBuild{

    public function setRemark($remark){
        $this->remark = $remark;
        return $this;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;
        return $this;
    }

    public function setMobile($mobile){
        $this->mobile = $mobile;
        return $this;
    }

    public function setEnterpriseId($enterprise_id){
        $this->enterprise_id = $enterprise_id;
        return $this;
    }

    public static function generate($user_id)
    {
        $model = new static();
        $model->setCreatedBy($user_id)->save();
        return $model;
    }
}
