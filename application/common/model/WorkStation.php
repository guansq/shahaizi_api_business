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
        $data = $this->where(implode(" AND ",$where)) -> paginate($pagesize ? $pagesize : 2);
        $read = $this -> is_read ($seller_id);
        foreach ($data as $key => $val)
        {
            $val["start_time"] = packDateFormat($val["start_time"]);
            $result[$key] = $val;
            $read && $result[$key]["is_read"] = in_array($val["air_id"],$read) ? 1 :  0;
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

        $status = I("status");
        $pagesize = I("pagesize");
        $this -> order_status($status) && $where[]= $this -> order_status($status);

        $data = $this -> order("air_id desc")->where(implode(" AND ",$where)) -> paginate($pagesize ? $pagesize : 2);

        if(trim($status) == "3,4")
        {
            $status_arr = ["3" => "wait_confirm","4" => "wait_start"];
            foreach ($data as $key => $val)
            {
                $val["start_time"] = packDateFormat($val["start_time"]);
                $result[$status_arr[$val["status"]]][] = $val;
            }
        }else
        {
            foreach ($data as $key => $val)
            {
                $val["start_time"] = packDateFormat($val["start_time"]);
                $result[$key] = $val;
            }
        }

        if(!$result)
            $result  = ["data" =>[] ];
        else
            $result  = ["data" =>$result ];
        jsonData(1,"返回成功",$result);

    }

    //进行中单独处理数据
    public function statusThree ($status)
    {

    }

    public function order_status ($status)
    {
        if($status == "" && $status !== 0)
            $status = 7;
        if($status == 7) //全部订单
        {
            $where = "is_pay = 1 AND status >= 3 ";
        }else
        {
            $where = "is_pay = 1 AND status in(".$status.")";
        }
//        if($status === 0) // 未付款
//        {
//            $where = "is_pay = 0 AND status = 0";
//        }elseif ($status == 1) //已付款,待派单
//        {
//            $where = "is_pay = 1 AND status = 1";
//        }elseif ($status == 2)//待接单
//        {
//            $where = "is_pay = 1 AND status = 2";
//        }elseif($status == 3)//进行中
//        {
//            $where = "is_pay = 1 AND status == 3";
//        }elseif($status == 4)//进行中
//        {
//            $where = "is_pay = 1 AND status == 4";
//        }elseif($status == 5)//待评价
//        {
//            $where = "is_pay = 1 AND status = 5";
//        }elseif($status == 6)//已完成
//        {
//            $where = "is_pay = 1 AND status = 6";
//        }elseif($status == 7)
//        {
//            $where = "is_pay = 1 AND status >= 3 ";
//        }

        return $where;
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
