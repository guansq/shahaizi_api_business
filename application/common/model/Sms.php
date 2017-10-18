<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */
namespace app\common\model;

use think\Db;
use think\Model;
use app\common\logic\FlashSaleLogic;
use app\common\logic\GroupBuyLogic;
use service\HttpService;
class Sms extends Model
{
    private $expire_time = 1800000;
    //private $common_sms_url = "http://shz.api.user.ruitukeji.cn:8502/index.php?m=Api&c=BaseMessage&a=sendInterCaptcha";
    public function sendSms ()
    {

        $mobile = I("mobile");
        $country_code = I("country_code");
        $type = I("opt");
        $seller_where = "mobile = $mobile";
        $seller = M("seller") -> field("country_code") -> where($seller_where) -> find();

        if($type == "resetpwd2" && !$seller)
            dataJson(4004,"该手机号没有账号",[]);

        if($type == "reg2" && $seller)
            dataJson(4004,"账号已经存在！",[]);

        if($seller)
            $country_code = $seller["country_code"];

        //$mobile = $country_code.$mobile;
        $where = "mobile = $mobile";
        $sms_info = M("sms_info") -> where($where) -> find();

        if($sms_info)
        {
            M("sms_info") -> where($where) -> save(["is_check" => 0,"create_time"=> time()]);
        }

        $data = ["mobile"=> $mobile,"countroy_code"=> $country_code,"opt" => $type];
        //print_r($data);die;
        $httpRet = HttpService::post(config('sms_url'), $data);
        $httpRet = json_decode($httpRet,true);
        if($httpRet["msg"] != "发送成功")
            dataJson(4004,$httpRet["msg"],[]);
        else
            dataJson(1,$httpRet["msg"],[]);
    }
   public function checkSms ($is_return = 0,$mobiles = 0,$codes = 0)//绑定  注册
   {

       $mobile = $mobiles ?  $mobiles :I("mobile");
       $code = $codes ? $codes : I("code");
       if(!$mobile)
           dataJson(4004,"手机号不能为空！", []);

       if(!$code)
           dataJson(4004,"code不能为空！", []);

       $check = M("sms_info") -> where("mobile = '$mobile' AND is_check = 0 AND code = '$codes'") -> find();
       //echo $check;die;->fetchSql(true)

       if($check){
           (time() - $check["create_at"]) > $this -> expire_time && dataJson(4004,"验证码已经失效！", []);
       }
       if($check && $check["code"] == $code)
       {
            if($is_return)
                return 1;
            else
                dataJson(1,"验证成功！", []);
       }else
       {
           dataJson(4004,"验证码错误！", []);
       }
   }

}
