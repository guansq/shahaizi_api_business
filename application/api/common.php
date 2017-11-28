<?php
/**
 * User: Administrator
 * Date: 2017/9/5
 * Time: 14:34
 */

use think\Validate;
use service\HttpService;
use DesUtils\DesUtils;
use think\Db;


// 返回数组
if(!function_exists('resultArray')){
    function resultArray($result = 0, $msg = '', $data = []){
        $code = $result;
        if(is_array($result)){
            $code = $result['status'];
            $msg = $result['msg'];
            $data = $result['result'];
        }
        if(empty($data)){
            $data = new stdClass();
        }
        $info = [
            'status' => $code,
            'msg' => empty($msg) ? '' : $msg,
            'result' => $data
        ];
        return $info;
    }
}

function jsonData ($result,$msg,$data)
{
    exit(json_encode(resultArray($result, $msg, $data)));
}

// 接口返回json 数据
if(!function_exists('returnJson')){
    function returnJson($result = 0, $msg = '', $data = []){
        $ret = resultArray($result, $msg, $data);
        header('Content-type:application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        exit(json_encode($ret));
    }
}

// 接口返回json 数据
if(!function_exists('dataJson')){
    function dataJson($result = 0, $msg = '', $data = []){
        header('Content-type:application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        exit(json_encode(["status" => $result,"msg" => $msg ,"result" => $data]));
    }
}
/*
 * 生成签名
 */
function createSign($sendData){
    $desClass = new DesUtils();
    $arrOrder = $desClass->naturalOrdering([$sendData['rt_appkey'],$sendData['req_time'],$sendData['req_action']]);
    $skArr = explode('_',config('app_access_key'));
    return $desClass->strEnc($arrOrder,$skArr[0],$skArr[1],$skArr[2]);//签名
}

/**
 * Auther: WILL<314112362@qq.com>
 * Time: 2017-3-20 17:51:09
 * Describe: 校验文件
 * @return bool
 */
if(!function_exists('validateFile')){
    function validateFile($files = [], $rule = ['size' => 1024*1024*20]){
        if(empty($files)){
            returnJson(4001, '缺少文件');
        }
        if(is_array($files)){
            foreach($files as $file){
                $validate = $file->check($rule);
                if(!$validate){
                    returnJson(4002, '', $file->getError());
                }
            }
            return true;
        }
        if(!$files->check($rule)){
            returnJson(4002, '', $files->getError());
        }
        return true;
    }
}
if(!function_exists('removeNull')){
    function  removeNull($array)
    {
        if($array)
        {
            array_walk($array,function ($v,$k) use (&$result){
                if(!is_null($v))
                    $result[$k] = $v;
                else
                    $result[$k] = '';
            });
            return $result;
        }
    }
}

/**
 * 司导日期转换
 * @param $date
 */
function packDateFormat($date,$isHour = 0)
{
    $week = ["周一","周二","周三","周四","周五","周六","周日"];
    $week_date = date("w",$date);
    if($isHour)
       return date("Y-m-d", $date)." ".$week[$week_date-1].date("H:i", $date);

    return date("Y-m-d", $date)." ".$week[$week_date-1];
}

function  getCarInfoName($brand_id = 0, $type_id = 0)
{
    $pack_info = M("pack_car_bar") -> where("id in ($brand_id, $type_id)") -> column("pid,car_info");
    $pack_info["brand_name"] = $pack_info[0];
    $pack_info["car_type_name"] = $pack_info[$brand_id];
    return $pack_info;
}

function  getCarInfoName2($brand_id = 0, $type_id = 0)
{
    $pack_info = M("pack_car_bar") -> where("id in ($brand_id, $type_id)") -> select();

    $pack_info["brand_name"] = $pack_info[0]["car_info"];
    $pack_info["car_type_name"] = $pack_info[1]["car_info"];
    return $pack_info;
}

function  getCarInfoNameBaseCarId($car_id)
{
    $car_data = M("pack_car_info") -> where("car_id = $car_id") -> find();
    if($car_data)
    {
        $pack_info = M("pack_car_bar") -> where("id in ({$car_data['brand_id']}, {$car_data['car_type_id']})") -> column("pid,car_info");
        $pack_info = array_values($pack_info);
        $pack_info["brand_name"] = $pack_info[0];
        $pack_info["car_type_name"] = $pack_info[1];
    }else
    {
        $pack_info["brand_name"] = "";
        $pack_info["car_type_name"] = "";
    }

    return $pack_info;
}

function getUpStartTime ($is_current_time = 0)
{
    $config = M("config") -> where("inc_type = 'overtime'") -> column("name, value");

    $overtime_time = $config["overtime_time"].":00";
//    echo $overtime_time;die;
    if($is_current_time == 1)
    {
        $current_date = date("Y-m-d",time());
        return  strtotime($current_date." ".$overtime_time);
    }elseif($is_current_time == 2)
    {
        return  $overtime_time;
    }
    return  ' UNIX_TIMESTAMP(concat(FROM_UNIXTIME(curdate(),"%Y-%m-%d"),"'.$overtime_time.'"))';//当天的上班时间  二不是starttime的上班时间
}

function getPlatformCharge($return_value = 0)
{
    $config = M("config") -> where("inc_type = 'car_setting_money' AND name = 'name_line'") -> find();
    if($return_value)
        return $config["value"];
    return  $config["value"]."%";
}


function  diffHour ($startDate,$endData)
{
    $config = M("config") -> where("inc_type = 'overtime'") -> column("name, value");
    $go_off_time = $config["go_off_time"];
    $current_date = date("Y-m-d",$startDate);
    $go_off_time_concat = $current_date." ".$go_off_time;//下班时间
    $end_date_data = date("Y-m-d H:i:s",$endData); //结束时间
    $hour_num  = round((strtotime($end_date_data)-strtotime($go_off_time_concat))%86400/3600);
    $price = $hour_num * $config["charge"];
    return  ["overtime_hour" => $hour_num,"charge" => $price];
}

//根据订单评论信息获取用户信息
function getUserInfo($comment_info)
{
    if($comment_info["type"] == 1)
        return M("users")->field("nickname,head_pic") -> where("user_id = {$comment_info["user_id"]}") -> find();
    elseif($comment_info["type"] == 3)
        return M("seller")->field("nickname,head_pic") -> where("seller_id = {$comment_info["user_id"]}") -> find();
}

function number2chinese($num,$mode = true,$sim = true){
    if(!is_numeric($num)) return '含有非数字非小数点字符！';
    $char    = $sim ? array('零','一','二','三','四','五','六','七','八','九')
        : array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
    $unit    = $sim ? array('','十','百','千','','万','亿','兆')
        : array('','拾','佰','仟','','萬','億','兆');
    $retval  = $mode ? '':'';
    //小数部分
    if(strpos($num, '.')){
        list($num,$dec) = explode('.', $num);
        $dec = strval(round($dec,2));
        if($mode){
            $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
        }else{
            for($i = 0,$c = strlen($dec);$i < $c;$i++) {
                $retval .= $char[$dec[$i]];
            }
        }
    }
    //整数部分
    $str = $mode ? strrev(intval($num)) : strrev($num);
    for($i = 0,$c = strlen($str);$i < $c;$i++) {
        $out[$i] = $char[$str[$i]];
        if($mode){
            $out[$i] .= $str[$i] != '0'? $unit[$i%4] : '';
            if($i>1 and $str[$i]+$str[$i-1] == 0){
                $out[$i] = '';
            }
            if($i%4 == 0){
                $out[$i] .= $unit[4+floor($i/4)];
            }
        }
    }
    $retval = join('',array_reverse($out)) . $retval;
    return $retval;
}

//筛选数组 3
function order_filter_three($elem){
    return $elem['status'] == 3;
}
//筛选数组 4
function order_filter_four($elem){
    return $elem['status'] == 4;
}
function order_type($type,$order_id)
{
    //1是接机 2是送机 3线路订单 4单次接送 5私人订制 6按天包车游
    if($type == 1)
    {
        $table = "pack_base_receive";
    }elseif($type == 2)
    {
        $table = "pack_base_send";
    }elseif($type == 3)
    {

    }
    elseif($type == 4)
    {
        $table = "pack_base_once";
    }
    elseif($type == 5)
    {
        $table = "pack_base_private";
    }
    elseif($type == 6)
    {
        $table = "pack_base_by_day";
    }
    $find_data = M($table) -> where("base_id = $order_id") -> find();
    if($find_data)
        $find_data["user_car_time"] = date("Y-m-d H:i:s",$find_data["user_car_time"]);

    return $find_data;
}

function setAccountLog ($seller_id,$add_money,$seller_money,$desc,$order_id=0)
{
    $data =
        [
            "seller_id" => $seller_id,
            "add_money" => $add_money,
            "seller_money" => $seller_money,
            "change_time" => time(),
            "desc" => $desc,
            "order_id" => $order_id
        ];
    M("driver_withdrawals") -> add($data);
}


/**
 * 发送极光消息
 * @param $user_id 用户id
 * @param int $user_type 用户类型 1是用户端 2是商家端
 * @param $msg_title
 * @param $msg_content
 * @param $device
 */
function sendJGMsg ($code,$user_id = 0,$user_type = 1)
{
    require_once VENDOR_PATH."jpush/jpush/autoload.php";

    if(!$user_id)
        $user_id = 0;
    $text = pushMsgText($code);
    if($user_type == 1)
    {
        $appkey = "ae18520eca229fc7e23c5f86";
        $secert = "7e5df030845bb7bcdfce058d";
        $where = "user_id = $user_id";
        $users = M("users") -> field("push_id") -> where($where) -> find();
        $registration_id = $users["push_id"];
        sendPush($registration_id,$appkey,$secert,$text);
    }elseif($user_type == 2)
    {
        $appkey = "17f7ed4f812eeb340553963d";
        $secert = "7f49e6a381ee00c4b3a7507a";
        $where = "seller_id = $user_id";
        $users = M("seller") -> field("device_no") -> where($where) -> find();
        $registration_id = $users["device_no"];
        sendPush($registration_id,$appkey,$secert,$text);
    }elseif($user_type == 3)
    {
        $appkey = "17f7ed4f812eeb340553963d";
        $secert = "7f49e6a381ee00c4b3a7507a";

        $user_id_data = explode(",", $user_id);
        if(is_array($user_id_data))
        {
            foreach ( $user_id_data as $key => $val )
            {
                $users = M("seller") -> field("device_no") -> where("seller_id = $val") -> find();
                sendPush($users["device_no"],$appkey,$secert,$text);
            }
        }

    }


}

function sendPush ($registration_id,$appkey,$secert,$text)
{
    if($registration_id)
    {
        $client = new \JPush\Client($appkey,$secert);
        $push_payload = $client -> push()
            ->setPlatform('all')
//            ->addAllAudience()
            ->addRegistrationId($registration_id)
            ->message($text["content"], array(
                'title' => $text["title"],
                // 'content_type' => 'text', 
                'extras' => array(
                    'key' => 'value',
                    'jiguang'
                ),
            ));
//            ->setNotificationAlert('');
        try {
            $response = $push_payload->send();

//            print_r($response);
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
//            print $e;
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
//            print $e;
        }
    }
}

function pushMsgText ($code)
{
    $codeData =
        [
            "0" =>
                [
                    "title" => "订单已接单",
                    "content" => "您的订单已被司导接单，如有问题请及时联系司导哟",
                ],
            "1" =>
                [
                    "title" => "订单已拒绝",
                    "content" => "您的订单已被司导拒绝，司导正在忙，换个司导为您服务吧",
                ],
            "2" =>
                [
                    "title" => "订单时间已修改",
                    "content" => "您的订单开始时间已与司导友好协商，订单时间已被司导修改",
                ],
            "3" =>
                [
                    "title" => "订单确认结束",
                    "content" => "您的出行服务已结束，司导已确认结束",
                ],
            "4" =>
                [
                    "title" => "订单结束，司导已评价",
                    "content" => "您的订单确认结束，服务您的司导已对订单进行评价",
                ],
            "5" =>
                [
                    "title" => "提现申请",
                    "content" => "您申请的一笔金额提现，正在处理中，请耐心等候",
                ],
            "6" =>
                [
                    "title" => "订单超时",
                    "content" => "您的订单已超时回收",
                ]

        ];
    return $codeData[$code];
}

/**
 * 根据订单ID 返回用户id
 * @param int $air_id
 * @param String $air_id
 */
function returnUserId($air_id,$type)
{
    $user_data =  M("pack_order") -> field("user_id,seller_id,allot_seller_id") -> where("air_id = $air_id") -> find();
    if( $type == "allot_seller_id" )
    {
        $allot_data = trim($user_data["allot_seller_id"],",");
        $user_data["allot_seller_id"] = $allot_data;
    }
    return $user_data[$type];
}