<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/15
 * Time: 13:40
 */

namespace app\api\controller\v2;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\User as UserModel;
use app\lib\exception\MissException;

/**
 * Banner资源
 */ 
class User extends BaseController
{
    public function getUserById($id){
        (new IDMustBePositiveInt())->check($id);
        $res = UserModel::getUserById($id);
        return $res;
    }
    public function getAllUsers(){
        $res = UserModel::getAllUsers();
        return $res;
    }
    public function getUserByFilter(){
        $filter = input('post.');
        //此处可能需要验证传入的参数是否合法
        $res = UserModel::getUserByFilter($filter);
        return $res;
    }
    public function getUserByCard($card_id){
        $filter = input('post.');
        (new IDMustBePositiveInt())->check($card_id);
        //此处可能需要验证传入的参数是否合法
        $res = UserModel::getUserByCard($card_id,$filter);
        return $res;
    }
}