<?php

namespace app\api\model;

use think\Model;

class System extends BaseModel
{
    public static function getSummary()
    {
        $system = self::withTrashed()->find();
        return $system;
    }
//    public static function updateOne($data)
//    {
//        return $system;
//    }
}
