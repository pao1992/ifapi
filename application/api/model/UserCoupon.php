<?php

namespace app\api\model;
use app\api\model\Coupon as CouponModel;
use think\Model;

class UserCoupon extends BaseModel
{
    protected $hidden = [ 'update_time'];
    protected $autoWriteTimestamp = true;



    public function user()
    {
        return $this->belongsTo('user', 'user_id', 'id');
    }
    public function coupon()
    {
        return $this->belongsTo('coupon', 'coupon_id', 'coupon_id');
    }
    public static function getAllUserCoupons($page=1, $size=20,$param='',$content=''){
        $model = new UserCoupon();
        $model->order('create_time desc')->with('user');
        if($param != '' && $content !=''){
            $model->where([$param => $content]);
        }
        $pagingData = $model->withTrashed()->order('id DESC')->paginate($size, false, ['page' => $page]);
        foreach ($pagingData as $k =>$v){
            $pagingData[$k]['coupon'] = CouponModel::withTrashed()->where(['coupon_id'=>$v['coupon_id']])->find();
        }
        return $pagingData ;
    }

}
