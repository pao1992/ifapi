<?php

namespace app\api\model;

use think\Model;

class Banner extends BaseModel
{
//    public function items()
//    {
//        return $this->hasMany('BannerItem', 'banner_id', 'id');
//    }
    //
    protected $autoWriteTimestamp = true;
    protected $hidden = ['create_time','delete_time', 'update_time'];
    /**
     * @param $id int banner所在位置
     * @return Banner
     */
    public static function getBannerById($id)
    {
        $banner = self::get($id);
        return $banner;
    }
    public static function getDataAttr($value)
    {
        return json_decode($value);
    }
}
