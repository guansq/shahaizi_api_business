<?php
/**
 * Created by PhpStorm.
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
function packDateFormat($date)
{
    $week = ["周一","周二","周三","周四","周五","周六","周日"];
    $week_date = date("w",$date);
    return date("Y-m-d", $date)." ".$week[$week_date-1].date("Y-m-d", $date);
}

function  getCarInfoName($brand_id = 0, $type_id = 0)
{
    $pack_info = M("pack_car_bar") -> where("id in ($brand_id, $type_id)") -> column("pid,car_info");
    $pack_info["brand_name"] = $pack_info[0];
    $pack_info["car_type_name"] = $pack_info[1];
    return $pack_info;
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
