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
            $drv_data = $this -> where("drv_id = {$seller_info["drv_id"]}") -> find();
            $imgArr["auth_status"] = 1;
            if(!empty($drv_data))
            {
                $this -> where("drv_id = ".$seller_info["drv_id"]) -> save($imgArr);
                jsonData(1,"上传成功",[]);
            }
        }

        $imgArr['auth_time'] = $post["auth_time"];
        $this -> add($imgArr);
        $insert_id = $this -> getLastInsID();
        $this -> where("drv_id = $insert_id") -> save(["auth_status" => 1]);
        M("seller") -> where("seller_id = $seller_id") -> save(["drv_id" => $insert_id]);


        jsonData(1,"上传成功",[]);
    }

    function getArea ()
    {
        $continent = I("continent"); //大洲
        $country = I("country"); //国家
        $province = I("province"); //省
        $city = I("city"); //市
        if(!$continent)
            $where =  "level = 1";
        else
            $where =  "parent_id = $continent";

        if($country)
        {
            if(!$province)
            {
                $whereRegion =  "parent_id = 0 AND country_id = $country";
            }else
            {
                $whereRegion =  "parent_id = $province AND country_id = $country";
            }

            $area_data = M("region") -> where($whereRegion) -> select();
            if($area_data)
                jsonData(1,"返回成功！",$area_data);
        }

        $getCountry = M("region_country") -> where($where) -> select();
        if($getCountry)
            jsonData(1,"返回成功！",$getCountry);
    }

    /**
     * 新增车辆
     */
    public function addCar ($seller_id)
    {
        $pack_car_info = db::name("pack_car_info");

        $car_id = I("car_id");
        $data['seller_id'] = $seller_id;
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

        if($car_id){
            $result['is_state'] = 0;//待审核
            $pack_car_info -> where("car_id = $car_id") -> save($result);
        }else{
            $pack_car_info -> add($result);
        }

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
            $car_info = getCarInfoName2($val["brand_id"], $val["car_type_id"]);
            $val["brand_name"] = $car_info["brand_name"];
            $val["car_type_name"] = $car_info["car_type_name"];
            $car_img = explode("|",$val["car_img"]);
            $val["car_img"] = array_filter($car_img) ? $car_img : [];
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

    public function getOverTime ($seller_id, $is_post = 0)
    {
        $air_id = I("air_id");
        if(!$air_id)
            dataJson(4004,"air_id不能为空！",[]);

        $pack_order_data = M("pack_order") -> where("seller_id = $seller_id AND air_id = $air_id") -> find();

        if($pack_order_data["status"] == 3 && $pack_order_data["type"] != 1 && $pack_order_data["type"] != 2) //订单进行中并且非接机送机
        {
            $overtime_data = diffHour($pack_order_data["start_time"], $pack_order_data["end_time"]);
            $pack_order["add_time_long"] = floatval($overtime_data["overtime_hour"]) < 0 ? 0 : $overtime_data["overtime_hour"] ;
            $pack_order["add_recharge"] = floatval($overtime_data["charge"]) < 0 ? 0 : $overtime_data["charge"];
            $pack_order["add_reason"] = $overtime_data["add_reason"];
            if(!$is_post)
            {
                M("pack_order") -> where("air_id = $air_id AND seller_id = $seller_id") -> save($pack_order);
                dataJson(1,"申请成功！",[]);
            }else
            {
                dataJson(1,"返回成功！",$pack_order);
            }

        }else
        {
            dataJson(4004,"接送机不能申请加班！",[]);
        }
    }
    /**
     * 添加加班费用
     */
    public function overtime_recharge ($seller_id)
    {
        $this->getOverTime($seller_id);
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
       $line_id = I("line_id");
       $line_title = I("line_title");
       $line_price = I("line_price");
       $car_id = I("car_id");
       $cover_img = I("cover_img");
       $bright_dot = I("bright_dot");
       $line_detail = I("line_detail");
       $play_day = count(json_decode(htmlspecialchars_decode($line_detail),true));
       if(!$line_title)
           dataJson(4004,"线路标题不能为空！",[]);

       if(!$line_price)
           dataJson(4004,"线路价格不能为空！",[]);

       if(!$car_id)
           dataJson(4004,"car_id不能为空！",[]);

       $line_body =
       [
            "seller_id" => $seller_id,
            "line_title" => $line_title,
            "line_price" => $line_price,
            "car_id" => $car_id,
            "cover_img" => $cover_img,
            "line_highlights" => $bright_dot,
            "line_detail" => $line_detail,
            "play_day" => $play_day
       ];
       if(!$line_id)
       {
           $line_body["create_at"] = time();
           if(M("pack_line") -> add($line_body))
               dataJson(1,"发布成功！",[]);
       }else
       {
           $line_body["update_at"] = time();
           if(M("pack_line") -> where("seller_id = $seller_id AND line_id = $line_id") -> save($line_body))
               dataJson(1,"修改成功！",[]);
       }
        dataJson(1,"操作失败！",[]);
    }

    public function line_detail($line_detail)
    {

    }

    /**
     * 提交评价
     */
    public function postComment($seller_id)
    {
        $order_id = I("order_id");
        $score = I("score");
        $content = I("content");
        $is_anonymous = I("is_anonymous");
        $image = I("image");
        $commemt_time = time();
        if(!$order_id)
            dataJson(4004,"订单id不能为空！",[]);

        if(!$content)
            dataJson(4004,"评论内容不能为空！",[]);

        if(!$score)
            dataJson(4004,"评分不能为空！",[]);

        if($is_anonymous == "")
            dataJson(4004,"是否匿名不能为空！",[]);

        $data["order_id"] = $order_id;
        $data["seller_score"] = $score;
        $data["content"] = $content;
        $data["is_anonymous"] = $is_anonymous;
        $data["commemt_time"] = $commemt_time;
        $data["user_id"] = $seller_id;
        $data["type"] = 2;
        $data["image"] = $image;
        $is_find = M("order_comment") -> where("order_id = $order_id AND user_id = $seller_id AND type = 2") -> find();
        if($is_find)
            dataJson(0,"您已经评价过该订单了！",[]);

        M("pack_order") -> where("seller_id = $seller_id AND air_id = $order_id") -> save(["seller_order_status" => 1]);
        $this -> addUserRecharge($order_id);
        M("order_comment") -> add($data);
        dataJson(1,"返回成功！",[]);
    }

    /**
     * 根据订单号增加用户余额
     */
    public function addUserRecharge ($air_id)
    {
       $pack_order = M("pack_order") -> where("air_id = $air_id") -> find();
       if($pack_order["seller_id"])
       {
           $user_money = floatval($pack_order["real_price"]) + floatval($pack_order["add_recharge"]);
           M("seller") -> where("seller_id = {$pack_order["seller_id"]}") -> save(["user_money" => $user_money]);
       }
    }

    public function line_detail2 ()
    {
        $line_detail =
        [
            [
                "date_num" => 1,
                "summary" => "这是摘要1",
                "port_detail" =>
                 [
                     ["port_num" => 1,
                         "port_coverImg" => "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
                         "port_detail" => "这是第一站1"
                     ],
                     ["port_num" => 2,
                         "port_coverImg" => "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
                         "port_detail" => "这是第二站2"
                     ]
                 ],
            ],
            [
                "date_num" => 2,
                "summary" => "这是摘要1",
                "port_detail" =>
                 [
                     ["port_num" => 1,
                         "port_coverImg" => "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
                         "port_detail" => "这是第一站1"
                     ],
                     ["port_num" => 2,
                         "port_coverImg" => "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
                         "port_detail" => "这是第二站2"
                     ]
                 ],
            ]
        ];

        $test =  json_encode($line_detail);
        echo count(json_decode($test,true));
    }

    /**
     * 获取线路列表
     */
    public function getLinelist ($seller_id)
    {
        $pagesize = I("pagesize");
        $pack_line = M("pack_line") -> order("line_id desc")
            -> where("seller_id = $seller_id AND is_del = 0")
            -> paginate($pagesize ? $pagesize : 10);

        if($pack_line)
        {
            foreach ($pack_line as $key => $val)
            {
                $val["line_price"] =  $val["line_price"];
//            $val["line_detail"] = json_decode(htmlspecialchars_decode($val["line_detail"]), true);
                unset($val["line_detail"]);
                if($val["car_id"])
                {
                    $car_data = M("pack_car_info") -> where("car_id = ".$val["car_id"]) -> find();
                    $car_img = array_filter(explode("|",$car_data["car_img"]));
                    $val["car_img"] = $car_img ? $car_img : [];
                }else
                {
                    $val["car_img"] = [];
                }
                $pack_line[$key] = $val;
            }
//            print_r($pack_line);die;
        }
        dataJson(1, "返回成功！", $pack_line);
    }

    public function getLineDetail ($seller_id, $isReturn = 0)
    {
        $line_id = I("line_id");
        if(!$line_id)
            dataJson(4004,"line_id不能为空！" ,[]);

        $pack_line = M("pack_line") -> order("line_id desc")
            -> where("seller_id = $seller_id AND line_id = $line_id AND is_del = 0")
            -> find();

        $pack_line["line_detail"] =json_decode(htmlspecialchars_decode($pack_line["line_detail"]), true);
        $pack_line["line_price"] =  $pack_line["line_price"];

        if(!$isReturn)
            dataJson(1, "返回成功！", $pack_line);
        else
            return $pack_line;
    }

    /**
     * 删除线路
     * @param $seller_id
     */
    public function delLine($seller_id)
    {
        $line_id = I("line_id");
        if(!$line_id)
            dataJson(1, "line_id不能为空！", []);
        M("pack_line") -> where("seller_id = $seller_id AND line_id in ($line_id)") -> save(["is_del" => 1]);
        dataJson(1, "删除成功！", []);
    }

    /**
     * 修改订单时间
     */
    function fixOrderTime ($seller_id)
    {
        $air_id = I("air_id");
        $time = I("time");
        $time = strtotime($time);
        if($time < time())
        {
            dataJson(0,"不能小于当前时间！",[]);
        }
        M("pack_order") -> where("seller_id = $seller_id AND air_id = $air_id") -> save(["start_time" => $time]);
        dataJson(1,"返回成功！",[]);
    }


    /**
     * 获取user_user_pic
     */
    public function user_head_pic (&$data)
    {
        if($data)
        {
            foreach ($data  as $key => $val)
            {
                $user_id = $val["user_id"];
                $headpic = M("users") -> field("head_pic,hx_user_name,nickname") -> where("user_id = $user_id") -> find();
                $val["user_head_pic"] = $headpic["head_pic"];
                $val["user_hx_user_name"] = $headpic["hx_user_name"];
                $val["user_nickname"] = $headpic["nickname"];
            }
        }
        //print_r($data);die;
    }

    public function getOrderCommentBaseOrderId ($seller_id)
    {
        $pagesize = I("pagesize");
        $air_id = I("air_id");
        if(!$air_id)
            dataJson(4004,"air_id不能为空！",[]);

        $pack_data = M("order_comment") -> where("type = 2 AND user_id = $seller_id AND order_id = $air_id") -> paginate($pagesize ? $pagesize :10);

        $pack_data = $pack_data -> toArray();
        $packData = $pack_data["data"];

        foreach ($packData as $key => $val)
        {
            $user_info = getUserInfo($val);
            $packData[$key]["head_pic"] = $user_info["head_pic"] ? $user_info["head_pic"] : "" ;
            $packData[$key]["nickname"] = $user_info["nickname"] ? $user_info["nickname"] : "" ;
            $packData[$key]["commemt_time"] = date("Y-m-d H:i:s",$packData[$key]["commemt_time"]);
        }

        if(!$packData)
            $packData = [];

        dataJson(1,"返回成功！",$packData);
    }


    public function getOrderAllComment ($seller_id)
    {
        $pagesize = I("pagesize");
        $pack_data = M("order_comment") -> where("type = 2 AND user_id = $seller_id") -> paginate($pagesize ? $pagesize :10);
        $pack_data = $pack_data -> toArray();
        $packData = $pack_data["data"];

        foreach ($packData as $key => $val)
        {
            $user_info = getUserInfo($val);
            $packData[$key]["head_pic"] = $user_info["head_pic"] ? $user_info["head_pic"] : "" ;
            $packData[$key]["nickname"] = $user_info["nickname"] ? $user_info["nickname"] : "" ;
            $packData[$key]["commemt_time"] = date("Y-m-d H:i:s",$packData[$key]["commemt_time"]);
        }

        if(!$packData)
            $packData = [];
        dataJson(1,"返回成功！",$packData);
    }

    public function uploadCoverImg ($seller_id)
    {
        $cover_img = I("cover_img");
        if(!$cover_img)
            dataJson(4004,"封面图片不能为空");
        M("seller") -> where("seller_id = $seller_id") -> save(["cover_img" => $cover_img]);
        dataJson(1,"上传成功",[]);
    }
}
