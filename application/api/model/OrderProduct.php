<?php

namespace app\api\model;

use think\Model;

class OrderProduct extends BaseModel
{
    protected $autoWriteTimestamp = true;

    protected function getSpecAttr($value){
        return json_decode($value);
    }
}
