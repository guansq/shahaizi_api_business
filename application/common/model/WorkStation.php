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
    public function getMyWorkStation ($seller_id)
    {
        $where[]= "allot_seller_id like '%,".$seller_id.",%'";
        $pagesize = I("pagesize");
        $data = $this->where(implode(" AND ",$where)) -> paginate($pagesize ? $pagesize : 4);
        $read = $this -> is_read ($seller_id);

        foreach ($data as $key => $val)
        {
            $val["start_time"] = packDateFormat($val["start_time"]);
            $val["order_title"] = $this->order_title($val["work_address"],$val["type"]);
            $val["use_car_num"] = $this->useCarNum($val["use_car_adult"], $val["use_car_children"]);
            $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
            $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";
            $result[$key] = $val;
            if($read)
                $result[$key]["is_read"] = in_array($val["air_id"],$read) ? 1 :  0;
            else
                $result[$key]["is_read"] = 0;
        }
        if(!$result)
            $result  = ["data" =>[] ];
        else
            $result  = ["data" =>$result ];
         jsonData(1,"返回成功",$result);

    }

    public function orderList ($seller_id)
    {
        $where[]= "seller_id = $seller_id";

        $status = trim(I("status"));
        $pagesize = I("pagesize");
        $this -> order_status($status) && $where[]= $this -> order_status($status);
        $data = $this -> order("air_id desc") -> where(implode(" AND ",$where)) -> paginate($pagesize ? $pagesize : 4);
        $time = time();

        if($status == "3,4") //进行中
        {
            $wait_start_data  = $this ->where("seller_id = $seller_id AND is_pay = 1 AND `status` = 3  AND start_time > $time") -> paginate(2);
            $wait_confirm_num  = $this ->where("seller_id = $seller_id AND is_pay = 1 AND `status` = 3  AND start_time <= $time") -> paginate(2);
            $result["wait_start"] = $this->order_data_manage($wait_start_data,3);
            $result["wait_confirm"] = $this->order_data_manage($wait_confirm_num,4);

        }else
        {
            foreach ($data as $key => $val)
            {
                if($val["status"] == 3)
                    $val["status"] = $this -> time_status($val["start_time"]);

                $val["start_time"] = packDateFormat($val["start_time"]);

                $val["order_title"] = $this->order_title($val["work_address"],$val["type"]);
                $val["use_car_num"] = $this->useCarNum($val["use_car_adult"], $val["use_car_children"]);
                $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
                $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";

                $result[$key] = $val;
            }
        }
        $result_num["wait_start_num"]  = $this ->where("seller_id = $seller_id AND is_pay = 1 AND `status` = 3  AND start_time > $time") -> count();
        $result_num["wait_confirm_num"]  = $this ->where("seller_id = $seller_id AND is_pay = 1 AND `status` = 3  AND start_time <= $time") -> count();

        if(!$result)
            $result  = ["data" =>[] ];
        else
            $result  = ["data" =>$result ];

        $result["wait_start_num"] = $result_num["wait_start_num"] ? $result_num["wait_start_num"] : 0;
        $result["wait_confirm_num"] = $result_num["wait_confirm_num"] ? $result_num["wait_confirm_num"] : 0;

        jsonData(1,"返回成功",$result);

    }

    public function order_data_manage ($data,$status)
    {
        foreach ($data as $key => $val)
        {
            $val["order_title"] = $this->order_title($val["work_address"],$val["type"]);
            $val["use_car_num"] = $this->useCarNum($val["use_car_adult"], $val["use_car_children"]);
            $val['seller_id']  && $seller_info = M("seller") -> where("seller_id = {$val['seller_id']}") -> find();
            $val["customer_head"] = $seller_info ? $seller_info["head_pic"] : "";
            $val["status"] = $status;
            $result[] = $val;
        }
        return $result;
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
        $time = time();
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
        }else if($status == 3)//进行中-待开始
        {
            $where = "is_pay = 1 AND status = 3 AND start_time > $time";

        }else if($status == 4)//进行中-待确认
        {
            $where = "is_pay = 1 AND status = 3 AND start_time <= $time";
        }else if($status == 5)//待评价
        {
            $where = "is_pay = 1 AND status = 5";
        }else if($status == 6)//已完成
        {
            $where = "is_pay = 1 AND status = 6";
        }else if($status == 7)
        {
            $where = "is_pay = 1 AND status >= 3 ";
        }

        if($status == "3,4") //所有进行中
        {
            $where = "is_pay = 1 AND status = 3";
        }

        return $where;
    }

    public function time_status ($start_time)
    {
        if($start_time - time() > 0)
        {
            $order_status = 3;
        }else
        {
            $order_status = 4;
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
        $pack_midstat = M("pack_midstat") -> where($where) -> find();
        if($pack_midstat)
             M("pack_midstat") -> where($where)-> save($data);
        else
             M("pack_midstat")-> add($data);

        jsonData(1,"已拒绝",[]);
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
        $data && $data["start_time"] = packDateFormat($data["start_time"]);
        if(!$data)
            $data  = [];
        else
            $data  = ["data" =>$data];
        jsonData(1,"返回成功",$data);
    }

    public function statusAir ($seller_id)
    {
        $air_id = I("air_id");
        $seller_data = $this -> where("seller_id = $seller_id AND air_id = $air_id") -> find();
        if($seller_data)
            jsonData(4004,"该订单已被接单",[]);
        else
        {
            $saveData = $this -> where("air_id = $air_id") -> save(["seller_id"=> $seller_id]);
            if($saveData)
                jsonData(1,"接单成功!",[]);
            else
                jsonData(4005,"接单失败!",[]);
        }
    }
}
