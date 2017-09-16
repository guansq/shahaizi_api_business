<?php
/**
 * User: Plator
 * Date: 2017/9/4
 * Time: 19:40
 */
namespace app\api\controller;
use service\HttpService;
class Sms{
    /**
     * @api {POST}  /index.php?m=Api&c=Sms&a=send  发送国家验证码done
     * @apiName     PostSend
     * @apiParam {string} country_code 区号
     * @apiParam {string} mobile 手机号
     * @apiParam {string} opt [reg] 为注册，空或其他为登陆或忘记密码
     * @apiGroup    SmsInfo
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "发送成功",
     *      "result": []
     *  }
     */
    public function send()
    {
        model("common/Sms") -> sendSms();
    }

    /**
     * 检查验证码
     */
    public function checkSms ()
    {
        model("common/Sms") -> checkSms();
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Sms&a=getCountry  获得国家区号done
     * @apiName     GetCountry
     * @apiGroup    SmsInfo
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功！",
     *      "result": [
     *      {
     *      "id": 214,
     *      "country": "中国",
     *      "mobile_prefix": "86",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 215,
     *      "country": "香港",
     *      "mobile_prefix": "852",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 216,
     *      "country": "澳门",
     *      "mobile_prefix": "853",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 217,
     *      "country": "台湾",
     *      "mobile_prefix": "886",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 218,
     *      "country": "马来西亚",
     *      "mobile_prefix": "60",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 219,
     *      "country": "印度尼西亚",
     *      "mobile_prefix": "62",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 220,
     *      "country": "菲律宾",
     *      "mobile_prefix": "63",
     *      "area": "亚洲"
     *      },
     *      {
     *      "id": 402,
     *      "country": "瓦努阿图",
     *      "mobile_prefix": "678",
     *      "area": "大洋洲"
     *      },
     *      {
     *      "id": 403,
     *      "country": "斐济",
     *      "mobile_prefix": "679",
     *      "area": "大洋洲"
     *      },
     *      {
     *      "id": 404,
     *      "country": "科克群岛",
     *      "mobile_prefix": "682",
     *      "area": "大洋洲"
     *      },
     *      {
     *      "id": 405,
     *      "country": "纽埃岛",
     *      "mobile_prefix": "683",
     *      "area": "大洋洲"
     *      },
     *      {
     *      "id": 406,
     *      "country": "东萨摩亚",
     *      "mobile_prefix": "684",
     *      "area": "大洋洲"
     *      }
     * }
     */
    /**
     * 获取国家
     */
    public function getCountry ()
    {
        $result = M("country_mobile_prefix") -> select();
        dataJson(1,"返回成功！",$result);
    }
}