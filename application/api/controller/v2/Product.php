<?php
/**
 * Created by 七月.
 * User: 七月
 * Date: 2017/2/15
 * Time: 1:00
 */

namespace app\api\controller\v2;

use think\Controller;
use think\Exception;
use app\lib\exception\SuccessMessage;
use app\api\model\Product as ProductModel;
use app\lib\exception\BaseException;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;
use app\api\validate\productCheck;

class Product extends Controller
{
    //{
//    protected $beforeActionList = [
//        'checkSuperScope' => ['only' => 'createOne,deleteOne']
//    ];
    function createOne(){
        //整理基本信息
        $data = input('post.');
            $model = new ProductModel();
            $res = $model->data($data, true)->save();
            // 提交事务
            if($res){
                return new SuccessMessage();
            }
    }
    public function getAllProducts(){
        $products = ProductModel::getAllProducts();
        return $products;
    }
    public function getOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if (!$product)
        {
            throw new ProductException();
        }
        return json($product);
    }

    /**
     * @return boolean
     */
    public function updateProduct($id)
    {
        //整理基本信息
        $data = input('post.');
        (new productCheck())->goCheck();
        $product = new ProductModel();
        $product->data($data, true);
        $product->where('product_id',$id);
        $res = $product->isUpdate(true)->save();
        if(!$res){
            throw new BaseException();
        }
        return new SuccessMessage();
    }
    /**
     * 获取某分类下全部商品(不分页）
     * @url /product/all?id=:category_id
     * @param int $id 分类id号
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function getByCategory($id = -1)
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        return $products;
    }
    public function deleteOne($id)
    {
        $res = ProductModel::destroy($id);
        if($res){
            return new SuccessMessage(['code' => '204']);
        }else{
            throw new BaseException();
        }
        //        ProductModel::destroy(1,true);
    }
}