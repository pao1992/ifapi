<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/19
 * Time: 11:28
 */

namespace app\api\controller\v2;


use app\api\controller\BaseController;
use app\api\model\UserCoupon as UserCouponModel;
use app\api\validate\CouponNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\BaseException;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use think\Controller;
use app\api\validate\PagingParameter;

class UserCoupon extends BaseController
{

    public function deleteOne($id)
    {
        (new IDMustBePositiveInt())->check($id);
        $res = UserCouponModel::destroy($id);
        if ($res) {
            return new SuccessMessage([
                'code' => 204
            ]);
        } else {
            throw new BaseException();
        }
    }

    public function check($id)
    {
        (new IDMustBePositiveInt())->check($id);

    }

    public function getAllUserCoupons($page = 1, $size = 20, $param = '', $content = '')
    {
        (new PagingParameter())->goCheck();
        $res = UserCouponModel::getAllUserCoupons($page, $size, $param, $content);
        return $res;
    }
}