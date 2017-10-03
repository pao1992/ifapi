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
use app\lib\exception\MissException;
use imgHandle\img;
class Upload extends BaseController
{
    public function index(){
        //$upfile = new upfile('file');
        //上传
        //$file = $upfile->doUpload('./uploads',true);
        //生成缩略图，缩略图默认位置./static/attached
        $img = new img();
        $img->thumb_maxwidth =400; //缩略图最大宽度
        $img->thumb_maxheight = 400; //缩略图最大高度
        $img->watermark_transparent = 100;//水印透明度
        $img->watermark_logo = "./static/logo/logo.png"; //水印LOGO地址,相对路径
        $res = $img->upload($_FILES['pic'],'product',true);//上传处理，顺便加水印
        $pic_original = $res['message'];
        //裁剪图片
        $pic_thumb = $img->reduceImage($pic_original, 300, 300, "product");
        $arr = array();
        $arr['original'] = substr($pic_original,2);
        $arr['thumb'] = substr($pic_thumb,2);
        return $arr;
    }




}