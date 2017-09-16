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
    private $common_sms_url = "http://shz.api.user.ruitukeji.cn:8502/index.php?m=Api&c=BaseMessage&a=sendInterCaptcha";
    public function sendSms ()
    {
        $mobile = I("mobile");
        $country_code = I("country_code");
        $type = I("opt");

        $seller = M("seller") -> field("country_code") -> where("mobile = $mobile") -> find();

        if($seller)

        if($seller)
            $mobile=$seller["country_code"].$mobile;
        else
            $mobile = $country_code.$mobile;

        $data = ["mobile"=> $mobile,"opt" => $type];
        $httpRet = HttpService::post($this -> common_sms_url, $data);
        $httpRet = json_decode($httpRet,true);

        if($httpRet["msg"] != "发送成功")
            dataJson(4004,$httpRet["msg"],[]);
        else
            dataJson(1,$httpRet["msg"],[]);
    }
   public function checkSms ($is_return = 0,$mobiles = 0,$codes = 0)
   {
       $mobile = $mobiles ?  $mobiles :I("mobile");
       $code = $codes ? $codes : I("code");
       if(!$mobile)
           dataJson(4004,"手机号不能为空！", []);

       if(!$code)
           dataJson(4004,"code不能为空！", []);

       $check = M("sms_info") -> where("mobile = '$mobile' AND is_check = 0") -> find();
       time() - $check["create_at"] > $this -> expire_time && dataJson(4004,"验证码已经失效！", []);

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
