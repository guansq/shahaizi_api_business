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
    protected $table = "pack_driver_apply";
    public function getImgInfo ($user_id)
    {
        $drv_data = M("seller") -> where("seller_id = $user_id") -> find();
        if($drv_data['drv_id'])
        {
            $ruit_pack_driver_apply =
                M("pack_driver_apply")
                    -> field("name,car_check_img,driver_img,drv_hold_img,drv_front_img,drv_back_img,guide_img,boat_img,auth_status")
                    -> where("drv_id = ".$drv_data['drv_id'])
                    -> find();

            $ruit_pack_driver_apply_result["name"] = $ruit_pack_driver_apply["name"];

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

            $ruit_pack_driver_apply_result["auth_status"] = $status_text;
            $ruit_pack_driver_apply_result["img"] =
                [
                    "must_info" =>
                    [
                        [
                            "title" => "车检证",
                            "img_url" => $ruit_pack_driver_apply["car_check_img"]
                        ],
                        [
                            "is_must" => 1,
                            "title" => "驾驶证",
                            "img_url" => $ruit_pack_driver_apply["driver_img"]
                        ],
                        [
                            "is_must" => 1,
                            "title" => "手持身份证正面照",
                            "img_url" => $ruit_pack_driver_apply["drv_hold_img"]
                        ],
                        [
                            "is_must" => 1,
                            "title" => "添加身份证正面",
                            "img_url" => $ruit_pack_driver_apply["drv_front_img"]
                        ],
                        [
                            "is_must" => 1,
                            "title" => "添加身份证反面",
                            "img_url" => $ruit_pack_driver_apply["drv_back_img"]
                        ],
                    ],
                    "non_mand" =>
                    [
                        [
                            "title" => "导游证",
                            "img_url" => $ruit_pack_driver_apply["guide_img"]
                        ],
                        [
                            "title" => "游艇驾驶证",
                            "img_url" => $ruit_pack_driver_apply["boat_img"]
                        ]
                    ]
                ];
        }
        else
            $ruit_pack_driver_apply_result = [];
        jsonData(1,"返回成功",$ruit_pack_driver_apply_result);
    }
}
