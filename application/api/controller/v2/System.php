<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 2:56
 */

namespace app\api\controller\v2;


use app\api\controller\BaseController;
use app\lib\exception\SuccessMessage;
use imgHandle\img;
use app\api\model\System as SystemModel;
use app\api\validate\BaseValidate;

class System extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'test']
    ];

    public function getSummary()
    {
        $system = SystemModel::getSummary();
        return $system;
    }

    public function updateOne()
    {
        $rule = [
            'tel'=>'require'
        ];
        $validate = new BaseValidate($rule);
        $validate->goCheck();
        $data = input('put.');
        $system = SystemModel::withTrashed()->where('id',1)->update($data);
        return new SuccessMessage();
    }

    public function updateLogo()
    {
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 20000))
        {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    "./static/logo/logo.png");
                return "static/logo/logo.png";

//                if (file_exists("upload/" . $_FILES["file"]["name"]))
//                {
//                    echo $_FILES["file"]["name"] . " already exists. ";
//                }
//                else
//                {
//                    move_uploaded_file($_FILES["file"]["tmp_name"],
//                        "upload/" . $_FILES["file"]["name"]);
//                    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
//                }
            }
        }
        else
        {
            echo "Invalid file";
        }
//        //生成缩略图，缩略图默认位置./static/attached
//        $img = new img();
//        $img->thumb_maxwidth =200; //缩略图最大宽度
//        $img->thumb_maxheight = 200; //缩略图最大高度
//        $img->watermark_transparent = 40;//水印透明度
//        $img->watermark_logo = "./static/logo/timg.jpg"; //水印LOGO地址,相对路径
//        $res = $img->upload($_FILES['file'],'logo',true);//上传处理，顺便加水印
//        $pic_original = $res['message'];
//        //裁剪图片
//        $pic_thumb = $img->reduceImage($pic_original, 200, 200, "logo");
//        $arr = array();
//        $arr['original'] = substr($pic_original,2);
//        $arr['thumb'] = substr($pic_thumb,2);
//        return $arr;
    }
}