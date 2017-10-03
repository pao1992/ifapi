<?php

namespace app\api\model;

use think\Model;

class Coupon extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;
    public function setStartAttr($value)
    {
        return strtotime($value);
    }
    public function setEndAttr($value)
    {
        return strtotime($value);
    }
    public function getStartAttr($value)
    {
        return date('Y/m/d',$value);
    }
    public function getEndAttr($value)
    {
        return date('Y/m/d',$value);
    }
    public static function getCouponsByDate($date){
        $res = self::where('start','<',$date)
            ->where('end','>',$date)->select();
        return $res;
    }
//
//    public function img()
//    {
//        return $this->belongsTo('Image', 'topic_img_id', 'id');
//    }
}
