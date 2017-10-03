<?php

namespace app\api\model;

use think\Model;

class Product extends BaseModel
{
    public function events(){
        return $this->hasOne('event');
    }
    protected $hidden = ['delete_time', 'from','create_time', 'update_time'];
//修改器
    public function setSpecAttr($value)
    {
        return json_encode($value);
    }
    public function setCategoryPathAttr($value)
    {
        return implode('_',$value);
    }
    public function setNumAttr($value)
    {
        return implode('_',$value);
    }
    public function getNumAttr($value)
    {
        return explode('_',$value);
    }
    public function getCategoryPathAttr($value)
    {
        return explode('_',$value);
    }
    public function getSpecAttr($value)
    {
        return json_decode($value);
    }
//    public function getPicOriginalAttr($value, $data)
//    {
//        return $this->prefixImgUrl($value, $data);
//    }
//    public function getPicThumbAttr($value, $data)
//    {
//        return $this->prefixImgUrl($value, $data);
//    }

    public static function getAllProducts(){
        $products = self::order('create_time desc')->select();
        return $products;
    }
    public static function getProductDetail($id)
    {
        $product = self::find($id);
        return $product;
    }
    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::with('events')->where('category_id',$categoryID)->select();
        return $products;
    }
}
