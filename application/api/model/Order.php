<?php

namespace app\api\model;

use think\Model;

class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;

    public function getSnapItemsAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    public function setBookTimeAttr($value)
    {
        return strtotime($value);
    }
    public function getBookTimeAttr($value)
    {
        return date('Y/m/d',$value);
    }
    public function getSnapAddressAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode(($value));
    }
    
    public static function getSummaryByUser($uid, $page=1, $size=15)
    {
        $pagingData = self::where('user_id', '=', $uid)
            ->order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData ;
    }

    public static function getSummaryByPage($page=1, $size=20,$param='',$content=''){
        $model = new Order();
        $model->order('create_time desc')->with('products');
        if($param != '' && $content !=''){
            $model->where([$param => $content]);
        }
        $pagingData = $model->paginate($size, false, ['page' => $page]);
        return $pagingData ;
    }
    public static function updateOne($id,$data){
        $res = self::where('order_id', $id)
            ->update($data);
        return $res;
    }

//    public function products()
//    {
//        return $this->belongsToMany('Product', 'order_product', 'product_id', 'order_id');
//    }
    public function products()
    {
        return $this->hasMany('order_product', 'order_id', 'order_id');
    }
}
