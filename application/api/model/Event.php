<?php

namespace app\api\model;

use think\Model;

class Event extends BaseModel
{
    protected $hidden = ['create_time','update_time','delete_time'];
    public function events()
    {
        return $this->hasMany('event_item','id','item_id');
    }
    protected function getDateAttr($value){
        return date('Y/m/d',$value);
    }
    protected function setDateAttr($value){
        return strtotime($value);
    }
}
