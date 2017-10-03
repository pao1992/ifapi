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
use app\api\model\Banner as BannerModel;
use app\lib\exception\MissException;
use imgHandle\img;

/**
 * Banner资源
 */ 
class Banner extends BaseController
{

    /**
     * 获取Banner信息
     * @url     /banner/:id
     * @http    get
     * @param   int $id banner id
     * @return  array of banner item , code 200
     * @throws  MissException
     */
    public function getBanner($id)
    {
        $validate = new IDMustBePositiveInt();
        $validate->goCheck();
        $banner = BannerModel::getBannerById($id);
        if (!$banner ) {
            throw new MissException([
                'msg' => '请求banner不存在',
                'errorCode' => 40000
            ]);
        }
        return $banner;
    }
    public function updateOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $model = new BannerModel();
        $data = input('put.');
        $data['data'] = json_encode($data['data']);
        $banner = $model->allowField(['data','name','description'])->isUpdate(true)->save($data,['id'=>$id]);

        return $banner;
    }
    public function addImage(){
        $img = new img();
        $img->thumb_maxwidth =400; //缩略图最大宽度
        $img->thumb_maxheight = 400; //缩略图最大高度
        $img->watermark_transparent = 100;//水印透明度
        $img->watermark_logo = "./static/logo/logo.png"; //水印LOGO地址,相对路径
        $res = $img->upload($_FILES['file'],'banner',true);//上传处理，顺便加水印
        $pic_original = $res['message'];
        //裁剪图片
        $pic_thumb = $img->reduceImage($pic_original, 400, 400, "banner");
        $arr = array();
        $arr['original'] = substr($pic_original,2);
        $arr['thumb'] = substr($pic_thumb,2);
        return $arr;
    }
}