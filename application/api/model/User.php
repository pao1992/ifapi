<?php

namespace app\api\model;

use think\Model;

class User extends BaseModel
{
    protected $autoWriteTimestamp = true;
//    protected $createTime = ;

    public function orders()
    {
        return $this->hasMany('Order', 'user_id', 'id');
    }
    public function coupons()
    {
        return $this->belongsToMany('Coupon', 'user_coupon','coupon_id');
    }

//    public function address()
//    {
//        return $this->hasOne('UserAddress', 'user_id', 'id');
//    }

    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }
    public static function getUserById($id){
        $user = self::where('id', '=', $id)
            ->find();
        return $user;
    }
    public static function getUserByFilter($filter){
        $user = self::where($filter)
            ->select();
        return $user;
    }
    public static function getAllUsers(){
        $users = self::select();
        return $users;
    }
    public static function getUserByCard($card_id,$filter){
        $user = self::where($filter)
            ->select();
        return $user;
    }
}
