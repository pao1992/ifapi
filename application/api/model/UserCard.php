<?php

namespace app\api\model;

use think\Model;
class UserCard extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;

    public function getUserCard($card_id)
    {
        $res = self::where(array('card_id'=>$card_id))->select();
        return $res;
    }
}
