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


    /**
     * 新增车辆
     */
    public function addCar ()
    {
        $pack_car_info = db::name("pack_car_info");

        $car_id = I("car_id");
        $data['seller_id'] = I("seller_id");
        $data['car_img'] = I("car_img");
        $data['brand_id'] = I("brand_id");
        $data['car_type_id'] = I("car_type_id");
        $data['seat_num'] = intval(I("seat_num"),0);
        $data['car_year'] = I("car_year");
        $data['is_customer_insurance'] = I("is_customer_insurance");

        $result = array_filter($data, function ($v){return $v != "";});

//        if($result['brand'])
//        {
//            $brand =  $pack_car_info -> where("brand = '{$result['brand']}'") -> find();
//            if($brand)
//                jsonData(4004, "车牌号重复！",[]);
//        }

        if($car_id)
            $pack_car_info -> where("car_id = $car_id") -> save($result);
        else
            $pack_car_info -> add($result);

        jsonData(1,"返回成功！",[]);
    }

    /**
     * 获取车辆信息表
     */
    public function getCarInfo ()
    {
        $brand_id = I("brand_id");
        if(empty($brand_id))
            $where = "pid = 0";
        else
            $where =  "pid = $brand_id";

        $pack_car_data = M("pack_car_bar") -> order("id,car_info,pid") -> where($where) -> select();

        dataJson(1,"返回成功", $pack_car_data);
    }



    /**
     * 获取我的车辆
     * @param $user_id
     */
    public function getMyAllCar ($user_id)
    {
        $all_car_info = M("pack_car_info") -> where("seller_id = $user_id") -> select();
        foreach($all_car_info as $key => $val)
        {
            $car_info = getCarInfoName($val["brand_id"], $val["car_type_id"]);
            $val["brand_name"] = $car_info["brand_name"];
            $val["car_type_name"] = $car_info["car_type_name"];
            $car_img = explode("|",$val["car_img"]);
            $val["car_img"] = $car_img ? $car_img : [];
            $result[] = $val;
        }
        dataJson(1,"返回成功",$result);
    }

    /**
     * 删除我的车辆
     */
    public function delMyCar ($seller_id)
    {
        $car_id = I("car_id");
        if($car_id)
             M("pack_car_info") -> where("car_id in ($car_id) AND seller_id = $seller_id") -> delete();
        else
            dataJson(4004,"car_id不能为空",[]);

        dataJson(1,"删除成功！",[]);
    }


    /**
     * 获取车辆详情
     */
    public function getMyCarInfo ($seller_id)
    {
        $car_id = I("car_id",0);
        if(!$car_id)
            dataJson(4004,"car_id不能为0或空",[]);

        $car_info = M("pack_car_info") -> where("car_id = $car_id AND seller_id = $seller_id") -> find();
        if(!$car_info)
            $car_info = [];
        else
            $car_info = removeNull($car_info);

        if($car_info)
        {
            $result = getCarInfoName($car_info["brand_id"],$car_info["car_type_id"]);
            $car_info["brand_name"] = $result["brand_name"];
            $car_info["car_type_name"] = $result["car_type_name"];
            $car_img = explode("|",$car_info["car_img"]);
            $car_info["car_img"] = array_filter($car_img) ? $car_img : [];
        }
        dataJson(1,"返回成功", $car_info);
    }

    /**
     * 确认订单
     */
    public function confirmOrder ($seller_id)
    {
        $air_id = I("air_id");
//        $pack_order_data = M("pack_order") -> where("seller_id = $seller_id AND air_id = $air_id") -> find();
        if(!$air_id)
            dataJson(4004,"air_id不能为0或空",[]);
        $status = 5; //待评价
        $time = time();

        $data["status"] = $status;
        $data["end_time"] = $time;

        M("pack_order") -> where("seller_id = $seller_id AND air_id = $air_id") -> save($data);
        dataJson(1,"确认成功！",[]);
    }


    /**
     * 添加加班费用
     */
    public function overtime_recharge ($seller_id)
    {
        $air_id = I("air_id");
        if(!$air_id)
            dataJson(4004,"air_id不能为空！",[]);

        $pack_order_data = M("pack_order") -> where("seller_id = $seller_id AND air_id = $air_id") -> find();

        if($pack_order_data["status"] == 3 && $pack_order_data["type"] != 1 && $pack_order_data["type"] != 2) //订单进行中并且非接机送机
        {
            $overtime_data = diffHour($pack_order_data["start_time"], $pack_order_data["end_time"]);
            $pack_order["add_time_long"] = $overtime_data["overtime_hour"];
            $pack_order["add_recharge"] = $overtime_data["charge"];

            M("pack_order") -> where("air_id = $air_id AND seller_id = $seller_id") -> save($pack_order);
            dataJson(1,"申请成功！",[]);
        }else
        {
            dataJson(4004,"接送机不能申请加班！",[]);
        }
    }

    /**
     * 司导帮助中心
     */
    public function help_center ()
    {
        $pagesize = I("pagesize");
        $pagesize = $pagesize ? $pagesize : 10;
        $article = M("article") -> where("cat_id = 22") -> paginate($pagesize);
        dataJson(1,"返回成功！",$article);
    }

    /**
     * 发布线路
     */
    public function publish_line ($seller_id)
    {
       $line_title = I("line_title");
       $line_price = I("line_price");
       $line_price = I("line_price");
       $brand_id = I("brand_id");
       $car_type_id = I("car_type_id");
       $cover_img = I("cover_img");
       $bright_dot = I("bright_dot");
       $line_detail = I("line_detail");
    }

    public function line_detail ($line_detail)
    {
        [
            "abstracts" => 11111,
            "port_num" =>
            [
                "cover_img" => "http://www.shaihaizi.com/111.jpg",
            ]
        ];
    }
}
