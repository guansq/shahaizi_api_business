<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导模型类
 */
namespace app\common\model;

use think\Db;
use think\Model;
use app\common\logic\FlashSaleLogic;
use app\common\logic\GroupBuyLogic;

class PackApply extends Model
{
    protected $table = "ruit_pack_driver_apply";
    public function getImgInfo ($user_id)
    {
        $drv_data = M("seller") -> where("seller_id = $user_id") -> find();
        if($drv_data['drv_id'])
        {
            $ruit_pack_driver_apply =
                M("pack_driver_apply")
                    -> field("name,car_check_img,driver_img,drv_hold_img,drv_front_img,drv_back_img,guide_img,boat_img,auth_status,auth_info")
                    -> where("drv_id = ".$drv_data['drv_id'])
                    -> find();
        }
        $ruit_pack_driver_apply_result["name"] = $ruit_pack_driver_apply["name"] ? $ruit_pack_driver_apply["name"] : '';

        switch ($ruit_pack_driver_apply["auth_status"])
        {
            case 0 :
                $status_text = "未认证";
                break;
            case 1 :
                $status_text = "认证通过";
                break;
            case 2 :
                $status_text = "认证中";
                break;
            case 3 :
                $status_text = "认证失败";
                break;
            default:
                $status_text = "未认证";
        }

        $ruit_pack_driver_apply_result["auth_status"] = $ruit_pack_driver_apply["auth_status"] ? $ruit_pack_driver_apply["auth_status"] : 0;
        $ruit_pack_driver_apply_result["auth_info"] = $ruit_pack_driver_apply["auth_info"] ? $ruit_pack_driver_apply["auth_info"] : "";
        $ruit_pack_driver_apply_result["status_text"] = $status_text ? $status_text : "";
        $ruit_pack_driver_apply_result["img"] =
        [
               [
                   "is_must" => 1,
                   "title" => "车检证",
                   "img_url" => $ruit_pack_driver_apply["car_check_img"] ? $ruit_pack_driver_apply["car_check_img"]: '',
                   "img_key" => "car_check_img"
               ],
               [
                   "is_must" => 1,
                   "title" => "驾驶证",
                   "img_url" => $ruit_pack_driver_apply["driver_img"] ? $ruit_pack_driver_apply["driver_img"] : '',
                   "img_key" => "driver_img"
               ],
               [
                   "is_must" => 1,
                   "title" => "手持身份证正面照",
                   "img_url" => $ruit_pack_driver_apply["drv_hold_img"] ? $ruit_pack_driver_apply["drv_hold_img"] : '',
                   "img_key" => "drv_hold_img"
               ],
               [
                   "is_must" => 1,
                   "title" => "身份证正面",
                   "img_url" => $ruit_pack_driver_apply["drv_front_img"] ? $ruit_pack_driver_apply["drv_front_img"] : '',
                   "img_key" => "drv_front_img"
               ],
               [
                   "is_must" => 1,
                   "title" => "身份证反面",
                   "img_url" => $ruit_pack_driver_apply["drv_back_img"] ? $ruit_pack_driver_apply["drv_back_img"] : '',
                   "img_key" => "drv_back_img"
               ],
               [
                   "is_must" => 0,
                   "title" => "导游证",
                   "img_url" => $ruit_pack_driver_apply["guide_img"] ? $ruit_pack_driver_apply["guide_img"] : '',
                   "img_key" => "guide_img"
               ],
               [
                   "is_must" => 0,
                   "title" => "游艇驾驶证",
                   "img_url" => $ruit_pack_driver_apply["boat_img"] ? $ruit_pack_driver_apply["boat_img"] : '',
                   "img_key" => "boat_img"
               ]
            ];
            jsonData(1,"返回成功",$ruit_pack_driver_apply_result);
    }


    /**
     *  上传证书
     */
    public function upload ($seller_id)
    {
        $post = array_filter(I("post."));
        $img = ["car_check_img","driver_img","drv_hold_img","drv_front_img","drv_back_img"];
        $diff = array_diff($img,array_keys($post));
        if($diff)
            jsonData(4004,"参数[".implode(",",$diff)."]不能为空！",[]);

        $seller_info = M("seller") -> field("drv_id") -> where("seller_id = $seller_id") -> find();

        $imgArr['car_check_img'] = $post["car_check_img"];
        $imgArr['driver_img'] = $post["driver_img"];
        $imgArr['drv_hold_img'] = $post["drv_hold_img"];
        $imgArr['drv_front_img'] = $post["drv_front_img"];
        $imgArr['drv_back_img'] = $post["drv_back_img"];
        $imgArr['guide_img'] = $post["guide_img"];
        $imgArr['boat_img'] = $post["boat_img"];

        if($seller_info["drv_id"])
        {
            $this -> where("drv_id = ".$seller_info["drv_id"]) -> save($imgArr);
        }else
        {
            $imgArr['auth_time'] = $post["auth_time"];
            $this -> add($imgArr);
            $insert_id = $this -> getLastInsID();
            M("seller") -> where("seller_id = $seller_id") -> save(["drv_id" => $insert_id]);
        }
        jsonData(1,"上传成功",[]);

    }
}
