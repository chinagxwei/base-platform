<?php

namespace App\Services\System;

use App\Models\Member\Member;
use App\Models\Member\MemberMessage;
use App\Models\System\SystemMessage;

class SystemMessageService
{
    public static function send($system_message_id)
    {

//        $system_msg = SystemMessage::findOneByID($system_message_id);
//
//        if ($system_msg->member_level >= 0) {
//            $members = (new Member())->searchBuild(['member_level' => $system_msg->member_level])->get();
//        } else {
//            $members = (new Member())->searchBuild()->get();
//        }
//
//        foreach ($members as $member) {
//
//            MemberMessage::generate($member->id, $system_msg->title, $system_msg->content, $system_message_id);
//        }

    }
}
