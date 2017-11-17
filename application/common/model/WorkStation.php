<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导工作台模型
 */
namespace app\common\model;

use think\Db;
use think\Model;
use app\common\logic\FlashSaleLogic;
use app\common\logic\GroupBuyLogic;

class WorkStation extends Model
{
    protected $table = "ruit_pack_order";

    //错过订单条件
    public function missWhere ($seller_id)
    {
        $up_time = getUpStartTime();
        $current_time = time();
        $time = todayBeginEnd();
        $missWhere = "is_pay = 1 AND `status` = 3  AND allot_seller_id like '%,$seller_id,%' AND seller_id <> $seller_id AND ((type not in (3,6) AND create_at >= '{$time['start_time']}' AND create_at <= '{$time['end_time']}') OR (type in(3,6) AND  $current_time < $up_time ))";
        return $missWhere;
    }
    public function getMyWorkStation ($seller_id)
    {
        $where[]= "s.seller_id = 0 AND s.allot_seller_id like '%,".$seller_id.",%'";
        $pagesize = I("pagesize");

        $data = $this -> alias("s")-> join("__PACK_MIDSTAT__ p"," s.air_id = p.air_id AND p.seller_id = $seller_id","left") -> field("s.*,p.is_read,p.is_refuse") -> where(implode(" AND ",$where)) ->order("p.is_read asc") -> paginate($pagesize ? $pagesize : 4);

//        echo $this -> getLastSql();die;
//        $read = $this -> is_read ($seller_id);
//            print_r($data);die;
        $refuse = $this -> is_refuse ($seller_id);
        //print_r($refuse);die;

        if($data)
        {
            $data = collection($data->items()) -> toArray();
            //print_r($data);die;
            foreach ($data as $key => &$val)
            {
                //如果是线路的start_time读线路的start_time
                if($val["type"] == 6 || $val["type"] == 3)
                    $val["start_time_detail"] = $this -> byDataTravel($val["air_id"]);
                else
                    $val["start_time_detail"] = packDateFormat($val["start_time"],1);

                if($val['type'] == 3 && $val['line_id']){
                    $week = ["周一","周二","周三","周四","周五","周六","周日"];
                    $week_date = date("w",strtotime($val["work_at"]));
                    $val["start_time_detail"] = date("Y-m-d", strtotime($val["work_at"]))." ".$week[$week_date-1];
                }
                $val["start_time"] = date("Y-m-d",$val["start_time"]);
                $val["end_time"] = date("Y-m-d",$val["end_time"]);

                $is_find = M("order_comment") -> where("order_id = ".$val["air_id"]." AND user_id = $seller_id AND type = 3") -> find();
                $val["seller_order_status"] = $is_find ? 1 : 0;
                $val["type"] !=3 && $val["line_data"] = order_type($val["type"],$val["air_id"]);
                $val["order_title"] = $this->order_title($val["work_address"],$val["type"]);
                $val["use_car_num"] = $this -> useCarNum($val["use_car_adult"], $val["use_car_children"]);
                $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
                $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";

                if($val["type"] == 3)
                {
                    if($val["line_id"])
                    {
                        $line_data = M("pack_line") -> where("line_id = ".$val["line_id"]) -> find();
                        $line_detail = json_decode(htmlspecialchars_decode($line_data["line_detail"]),true);
                        $endline = end($line_detail);
                        $val["work_address"] = $line_detail[0]["port_detail"][0]["site_name"];

                        $val["dest_address"] = array_reverse($endline["port_detail"])[0]["site_name"];//反转数组
                    }
                }


                $val["is_admin"] = $val["line_id"] ? $this->getAdminBaseLineId($val["line_id"]) : 1;
                //$result[] = $val;
//                if($read)
//                    $val["is_read"] = in_array($val["air_id"],$read) ? 1 :  0;
//                else
//                    $val["is_read"] = 0;
                $val["is_read"] = $val["is_read"] ? 1 :  0;
                if($refuse && in_array($val["air_id"],$refuse)){
                    array_splice($data,$key,1);
                    //unset($data[$key]);
                }
                //$data = array_merge($data);
            }
            $this -> user_head_pic($data);
        }

        //print_r($data);die;
        $where = $this->missWhere($seller_id);

        $count = M("pack_order")
            -> field("type,work_address,dest_address,real_price,create_at")
            -> where($where)
            -> count();

        //echo M("pack_order") -> getLastSql(true);die;
        if(!$data)
            $results  = ["data" =>[] ,"count" => $count];
        else
            $results  = ["data" =>$data ,"count" => $count];
        //print_r($data);die;

         jsonData(1,"返回成功",$results);

    }

    public function orderList ($seller_id)
    {
        $where = "seller_id = $seller_id";

        $status = trim(I("status"));
        $pagesize = I("pagesize");
        $up_time = getUpStartTime();
        $current_time = time();


        $common_where = $where." AND is_pay = 1 AND `status` = 3 ";
        //当天上班时间
        $confirm_where = $common_where." AND ( (type in(3,6) AND $current_time > $up_time) OR (type not in(3,6) AND start_time < $current_time) )";//上班时间>当前时间
        $wait_where = $common_where." AND ( (type in(3,6) AND $current_time <= $up_time) OR (type not in(3,6) AND start_time >= $current_time) )";//上班时间>当前时间  AND $current_time < $up_time

        if($status == 3)
        {
            $where = $wait_where;
        }elseif ($status == 4)
        {
            $where = $confirm_where;
        }

        $this -> order_status($status) && $where = $where . " AND ".$this -> order_status($status);

        $data = $this -> order("air_id desc") -> where($where) -> paginate($pagesize ? $pagesize : 4);
        $order_size = $this -> order("air_id desc") -> where($where) -> count();


        if($status == "3,4") //进行中
        {
            $wait_start_data  = $this -> order("air_id desc") -> where($wait_where) -> paginate(2);
            $this -> user_head_pic($wait_start_data);
            $wait_confirm_num  = $this -> order("air_id desc") -> where($confirm_where) -> paginate(2);
            $this -> user_head_pic($wait_confirm_num);
            $wait_start = $this -> order_data_manage($wait_start_data, 3);
            //dump($wait_start);die;
            $this->resultBatch($wait_start);

            $result["wait_start"] = $wait_start ? $wait_start  : [];
            $wait_confirm = $this -> order_data_manage($wait_confirm_num, 4);
            $this->resultBatch($wait_confirm);
            $result["wait_confirm"] = $wait_confirm ? $wait_confirm : [];

        }else
        {
            if($data)
            {
                $data = $data ->toArray();
                $data = $data["data"];

                foreach ($data as $key => $val)
                {
                    if($val["status"] == 3)
                        $val["start_time"] &&  $val["status"] = $this -> time_status($val["type"],$val["start_time"]);

                    if($val["type"] == 6 || $val["type"] == 3)
                        $val["start_time_detail"] = $this -> byDataTravel($val["air_id"]);
                    else
                        $val["start_time_detail"] = packDateFormat($val["start_time"],1);

                    $val["start_time"] = date("Y-m-d",$val["start_time"]);
                    $val["end_time"] = date("Y-m-d",$val["end_time"]);
                    $is_find = M("order_comment") -> where("order_id = ".$val["air_id"]." AND user_id = $seller_id AND type = 3") -> find();
                    $val["seller_order_status"] = $is_find ? 1 : 0;
                    $val["order_title"] = $this -> order_title($val["work_address"],$val["type"]);
                    $val["use_car_num"] = $this -> useCarNum($val["use_car_adult"], $val["use_car_children"]);
                    $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
                    $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";
                    $result[$key] = $val;
                }

                $this->resultBatch($result);

                $this->user_head_pic($result);
            }

        }
//        if($status ==3){
//            $result && $result= array_filter($result, 'order_filter_three');
//        }else if($status ==4){
//            $result = array_filter($result, 'order_filter_four');
//        }


        $wait_start_num  = $this -> where($wait_where) -> count();
        $wait_confirm_num  = $this -> where($confirm_where) -> count();
        $final["order_size"] = $order_size;
        $final["wait_start_num"] = $wait_start_num ? $wait_start_num : 0;
        $final["wait_confirm_num"] = $wait_confirm_num ? $wait_confirm_num : 0;
        $final["data"] = $result ? $result : [];

        jsonData(1,"返回成功",$final);

    }

    /**
     * 按天包车游时间
     */
    public function byDataTravel ($air_id)
    {
        if($air_id)
        {
            $pack_time = M("pack_base_by_day") -> where("base_id = $air_id") -> find();
            $pack_data = array_filter(explode("|",$pack_time["pack_time"]));
            if($pack_data)
            {
                foreach ($pack_data as $key => $val)
                    $str[] = date("Y-m-d",$val);
            }
            return $str ? implode(",",$str) : "";
        }
    }

    /**
     * 根据线路id判断是否是管理员
     * @param $line_id
     * @return int
     */
    public function getAdminBaseLineId ($line_id)
    {
        $line_data = M("pack_line") -> field("is_admin") -> where("line_id = $line_id") -> find();
        return $line_data["is_admin"] ? 1 : 0;
    }

    public function orderNum ($seller_id)
    {
        $where = "seller_id = $seller_id AND seller_order_status = 0";

        $result = $this -> field("status,COUNT(air_id) status_count") -> group("`status`")-> where($where) -> select();
        foreach($result as $key => $val)
        {
            $data[$val["status"]] = $val["status_count"];
        }

        $final["progress"] = $data[3] ? $data[3] : 0;
        $final["wait_comment"] = $data[5] ? $data[5] : 0;

        jsonData(1,"返回成功",$final);

    }

    public function resultBatch (&$result)
    {
       if($result)
       {
           foreach($result as $key => &$val)
           {
               if($val["type"] == 3)
               {
                   if($val["line_id"])
                   {
                       $line_data = M("pack_line") -> where("line_id = ".$val["line_id"]) -> find();
                       $line_detail = json_decode(htmlspecialchars_decode($line_data["line_detail"]),true);
                       if($line_detail)
                       {
                           $endline = end($line_detail);
                           $line_detail[0] && $val["work_address"] = $line_detail[0]["port_detail"][0]["site_name"];
                           $endline && $val["dest_address"] = $endline["port_detail"][0]["site_name"];
                       }else{
                           $val["work_address"] = '没有该路线';
                           $val["dest_address"] = '没有该路线';
                       }
                       //                print_r($line_detail);die;
                   }
               }
               $val && $val["is_admin"] = $val["line_id"] ? $this->getAdminBaseLineId($val["line_id"]) : 1;
           }
       }
    }

    public function order_data_manage ($data,$status)
    {
        foreach ($data as $key => $val)
        {
            $val["order_title"] = $this -> order_title($val["work_address"],$val["type"]);
            $val["use_car_num"] = $this -> useCarNum($val["use_car_adult"], $val["use_car_children"]);

            if($val["type"] == 6 || $val["type"] == 3)
                $val["start_time_detail"] = $this -> byDataTravel($val["air_id"]);
            else
                $val["start_time_detail"] = packDateFormat($val["start_time"], 1);

            $val["start_time"] = date("Y-m-d",$val["start_time"]);
            $val["end_time"] = date("Y-m-d",$val["end_time"]);
            $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
            $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";
            $val["status"] = $status;
            $result[] = $val;
        }
        return $result;
    }

    /**
     * 获取user_user_pic
     */
    public function user_head_pic (&$data,$single=0)
    {
        if($data)
        {
            if($single)
            {
                $user_id = $data["user_id"];
                $headpic = M("users") -> field("head_pic, hx_user_name, nickname") -> where("user_id = $user_id") -> find();
                $data["user_head_pic"] = $headpic["head_pic"];
                $data["user_hx_user_name"] = $headpic["hx_user_name"];
                $data["user_nickname"] = $headpic["nickname"];
            }else
            {
                foreach ($data  as $key => &$val)
                {
                    $user_id = $val["user_id"];
                    $headpic = M("users") -> field("head_pic, hx_user_name, nickname") -> where("user_id = $user_id") -> find();
                    $val["user_head_pic"] = $headpic["head_pic"];
                    $val["user_hx_user_name"] = $headpic["hx_user_name"];
                    $val["user_nickname"] = $headpic["nickname"];
                }
            }
        }
        //print_r($data);die;
    }

    public function useCarNum ($use_car_adult, $use_car_children)
    {
        $use_car_children = $use_car_children ? $use_car_children."儿童" : '';
        $use_car_adult = $use_car_adult ? $use_car_adult ."成人 " : '';
        return trim($use_car_adult.$use_car_children);
    }
    public function order_title ($work_address, $type)
    {
        if($type == 1)
            $type_name = "接机服务";
        else
            $type_name = "送机服务";

        return trim($work_address.$type_name);
    }
    public function order_status ($status)
    {
        $status = trim($status);
        $up_time = getUpStartTime();
        $current_time = time();
        if($status == "" && $status !== 0)
            $status = 7;

        if($status == 0) // 未付款
        {
            $where = "is_pay = 0 AND status = 0";
        }else if ($status == 1) //已付款,待派单
        {
            $where = "is_pay = 1 AND status = 1";
        }else if ($status == 2)//待接单
        {
            $where = "is_pay = 1 AND status = 2";
        }else if($status == 5)//待评价
        {
            $where = "is_pay = 1 AND status = 5 AND seller_order_status = 0";
        }else if($status == 6)//已完成
        {
            $where = "is_pay = 1 AND status = 6";
        }else if($status == 7)
        {
            $where = "is_pay = 1 AND status >= 3 ";
        }
        else if($status == 8)
        {
            $where = "is_pay = 1 AND seller_order_status = 1 ";
        }

        //        if($status == "3,4") //所有进行中
        //        {
        //            $where = "is_pay = 1 AND status = 3";
        //        }

        return $where;
    }

    public function time_status ($type, $start_time)
    {
        if(in_array($type,[1,2,4,5,7]))
        {
            if($start_time - time() < 0)
            {
                $order_status = 4;//待确认
            }else
            {
                $order_status = 3;//待开始
            }
            return $order_status;
        }

        //3 6 当前时间和当天上班时间比
        $up_time = getUpStartTime(2);//2017-10-23 8:30:0

        $current_date = date("Y-m-d", $start_time) . " " .$up_time;

        //echo $start_time;die;//2017-10-23 8:0:0
        if($current_date - $up_time > 0)
        {
            $order_status = 4;//待确认
        }else
        {
            $order_status = 3;//待开始
        }
        return  $order_status;
    }

    public function is_read ($seller_id)
    {
        if($seller_id)
        {
            $where[] = "is_refuse = 0";
            $where[] = "is_read = 1";
            $where[] = "seller_id = $seller_id";
            $whereConditon = implode(" AND ", $where);
            return  M("pack_midstat") -> where($whereConditon) -> column("air_id");
        }
    }

    public function is_refuse ($seller_id)
    {
        if($seller_id)
        {
            $where[] = "is_refuse = 1";
            $where[] = "seller_id = $seller_id";
            $whereConditon = implode(" AND ", $where);
            return  M("pack_midstat") -> where($whereConditon) -> column("air_id");
        }
    }

    /**
     * 错过的订单
     */
    public function miss_order ($seller_id)
    {
        $pagesize = I("pagesize");
        $where = $this->missWhere($seller_id);
        $count = M("pack_order")
            -> field("type,work_address,dest_address,real_price,create_at")
            -> where($where)
            -> count();

        $order_data = M("pack_order")
            -> field("type,work_address,dest_address,real_price,create_at")
            -> where($where)
            -> order("create_at desc")
            -> paginate($pagesize ? $pagesize : 10);

        foreach ($order_data as $key => $val)
        {
            $val["create_at"] = date("Y-m-d", $val["create_at"] );
            $order_result[$key] = $val;
        }

        $result = ["data" => $order_result,"count" => $count];
        dataJson(1,"返回成功！", $result);
    }

    /**
     * 订单拒绝
     */
    public function order_refuse ($seller_id)
    {
        $air_id = I("air_id");
        if(!$air_id)
            jsonData(4004,"air_id不能为空",[]);

        $where = "seller_id = $seller_id AND air_id = $air_id";
        $data =
        [
            "seller_id" => $seller_id,
            "air_id" => $air_id,
            "is_read" => 1,
            "is_refuse" => 1
        ];
        //print_r($data);die;
        $pack_midstat = M("pack_midstat") -> where($where) -> find();

        if($pack_midstat["is_refuse"] == 1)
            jsonData(4004,"您已经拒绝过了！",[]);

        if($pack_midstat)
            M("pack_midstat") -> where($where)-> save($data);
        else
            M("pack_midstat")-> add($data);
        sendJGMsg(1,returnUserId($air_id, "user_id"));
        jsonData(1,"已拒绝",[]);
    }

    /**
     * 订单已读
     */
    public function order_readed ($seller_id, $air_id)
    {
        $where = "seller_id = $seller_id AND air_id = $air_id";
        $data =
            [
                "seller_id" => $seller_id,
                "air_id" => $air_id,
                "is_read" => 1,
                "is_refuse" => 0
            ];
        $pack_midstat = M("pack_midstat") -> where($where) -> find();
        if($pack_midstat)
            M("pack_midstat") -> where($where)-> save($data);
        else
            M("pack_midstat")-> add($data);
    }

    public function getMyWorkSingleStation ($seller_id)
    {
        $air_id = I("air_id");
        if(empty(trim($air_id)))
            jsonData(4004,"air_id不能为空",[]);

        //        $where[]= "seller_id = $seller_id";
        $where[]= "air_id = $air_id";
        $whereCondition = implode(" AND ",$where);
        $data = $this->where($whereCondition) -> find();
        if($data["seller_id"])
        {
            if($data["seller_id"] != $seller_id)
                jsonData(4004,"您已经错过该订单！",[]);
        }

        if($data)
        {
            if($data["type"] == 3 || $data["type"] == 6)
                $data["start_time_detail"] = $this -> byDataTravel($data["air_id"]);
            else
                $data["start_time_detail"] = packDateFormat($data["start_time"], 1);
        }

        if($data["status"] == 3)
            $data["start_time"] && $data["status"] = $this -> time_status($data["type"],$data["start_time"]);

        if($data["type"] == 3)
        {
            if($data["line_id"])
            {
                $line_data = M("pack_line") -> where("line_id = ".$data["line_id"]) -> find();

                $line_detail = json_decode(htmlspecialchars_decode($line_data["line_detail"]),true);
                if($line_detail)
                {
                    $endline = end($line_detail);

                    $line_detail[0] && $data["work_address"] = $line_detail[0]["port_detail"][0]["site_name"];
                    $endArray=end($endline["port_detail"]);
                    $endline && $data["dest_address"] = $endArray["site_name"];
                    // print_r($line_detail);die;
                }
                $week = ["周一","周二","周三","周四","周五","周六","周日"];
                $week_date = date("w",strtotime($data["work_at"]));
                $data["start_time_detail"] = $data["work_at"]." ".$week[$week_date-1];
//                $data["start_time_detail"] = date("Y-m-d", strtotime($data["work_at"]))." ".$week[$week_date-1];
                //$data["start_time_detail"] = packDateFormat($data["start_time"]);
            }
        }
        $data && $data["is_admin"] = $data["line_id"] ? $this->getAdminBaseLineId($data["line_id"]) : 1;
        $cost_compensation = array_filter(explode("###",$data["cost_compensation"]));

        if($cost_compensation)
        {
            if($cost_compensation[0] == "cover_img_k")
                $data["cost_compensation_txt"] = "宽松";
            elseif($cost_compensation[0] == "cover_img_z")
                $data["cost_compensation_txt"] = "中等";
            elseif($cost_compensation[0] == "cover_img_y")
                $data["cost_compensation_txt"] = "严格";
            elseif($cost_compensation[0] == "cover_img_n")
                $data["cost_compensation_txt"] = "不退订";

            $data["cost_compensation"] = $cost_compensation[1];
        }else
        {
            $data["cost_compensation_txt"] = "宽松";
            $data["cost_compensation"] = "";
        }


        $data["start_time"] = date("Y-m-d",$data["start_time"]);
        $data["end_time"] = date("Y-m-d",$data["end_time"]);
        $data["use_car_num"] = $this->useCarNum($data["use_car_adult"], $data["use_car_children"]);
        $this->order_readed($seller_id,$air_id);
        $this -> user_head_pic($data,1);
        if(!$data)
            $data  = [];
        else
            $data  = ["data" =>$data];
        jsonData(1,"返回成功",$data);
    }

    public function statusAir ($seller_id)
    {
        $air_id = I("air_id");
        $car_id = I("car_id");
        $seller_data = $this -> where("seller_id = $seller_id AND air_id = $air_id") -> find();
        if($seller_data)
            jsonData(4004,"该订单已被接单",[]);
        else
        {
            $car_info = getCarInfoNameBaseCarId($car_id);
            //            print_r($car_info);die;
            $car_data =
                [
                    "con_car_id" => $car_id,
                    "con_car_type" => $car_info["brand_name"]." ".$car_info["car_type_name"],
                    "seller_id"=> $seller_id,
                    "status" => 3
                ];
            $saveData = $this -> where("air_id = $air_id") -> save($car_data);
            if($saveData)
            {
                sendJGMsg(0, returnUserId($air_id, "user_id"));
                jsonData(1,"接单成功!",[]);
            }
            else
                jsonData(4005,"接单失败!",[]);
        }
    }

    /**
     * 更新订单时间
     */
    public function updateTime ($seller_id)
    {
        $time_new = I("time_new");
        $air_id = I("air_id");
        if(!$time_new)
            jsonData(4004,"时间不能为空!",[]);

        if(!$air_id)
            jsonData(4004,"air_id不能为空!",[]);

        $config = M("config") -> where("inc_type = 'overtime'") -> column("name, value");
        $time = explode(":",$config["go_off_time"]);
        $hour = explode(":",$time_new);

        if(count($time) == 1)
            $time[1] = 0;
        if(count($hour) == 1)
            $hour[1] = 0;

        if ($hour[0] > $time[0] || ($hour[0] == $time[0] && $hour[1] > $time[1]))
            jsonData(4004,"不能大于下班时间!",[]);

        M("pack_order") -> where("air_id = $air_id AND seller_id = $seller_id") -> save(["start_time" => $time_new]);


        sendJGMsg(2,returnUserId($air_id, "user_id"));
        jsonData(1,"时间更新成功!",[]);
    }
}
