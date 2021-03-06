<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 */
namespace app\api\controller;

use app\common\logic\CartLogic;
use app\common\logic\OrderLogic;
use app\common\logic\StoreLogic;
use app\common\logic\UsersLogic;
use app\common\logic\CommentLogic;
use app\common\logic\CouponLogic;
use think\Page;
use service\MsgService;

class User extends Base {
    public $userLogic;

    /**
     * 析构流函数
     */
    public function  __construct() {
        parent::__construct();
        $this->userLogic = new UsersLogic();
    }

    /**
     * @api    {GET} /index.php?m=Api&c=User&a=getMyInfo     获取商家个人信息done
     * @apiName  getMyInfo
     * @apiGroup User
     * @apiParam {String} token   token值
     * @apiSuccessExample {json}    Success-Response:
     *  Http/1.1   200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *      "seller_id": 20,
     *      "sex": "",
     *      "nickname": "13222222222",
     *      "language": "",
     *      "head_pic": "",
     *      "briefing": "",
     *       "img_url" :{
     *      }
     *      }
     *      }
     *   @apiErrorExample {json}  Error-Response:
     *  Http/1.1   404 NOT FOUND
     * {
     *     "status": -1,
     *     "msg": "请填写账号或密码",
     *     "result": ""
     * }
     */
    public function getMyInfo ()
    {
        $seller_info = M("seller")
            -> field("seller_id,country_id,province,mandarin,signature,city,sex,nickname,language,head_pic, briefing, img_url")
            -> where("seller_id = ".$this -> user_id)
            -> find();
        if($seller_info["img_url"])
            $seller_info["img_url"] = explode("|", $seller_info["img_url"]);
        else
            $seller_info["img_url"] = [];

        $this -> getAreaName($seller_info);

        jsonData(1,"返回成功",$seller_info);
    }

    /**
     * @api      {GET} /index.php?m=Api&c=User&a=getMine   我的done
     * @apiName  getMine
     * @apiGroup User
     * @apiParam {String} token   token值
     * @apiSuccessExample {json}    Success-Response:
     *  Http/1.1   200 OK
     * {
     *      "status": 1,
     *      "msg": "登陆成功",
     *      "result": {
     *      "user_id": "1",
     *      "email": "398145059@qq.com",
     *      "password": "e10adc3949ba59abbe56e057f20f883e",
     *      "sex": "1",
     *      "birthday": "2015-12-30",
     *      "user_money": "9999.39",
     *      "frozen_money": "0.00",
     *      "pay_points": "5281",
     *      "address_id": "3",
     *      "reg_time": "1245048540",
     *      "last_login": "1444134213",
     *      "last_ip": "127.0.0.1",
     *      "qq": "3981450598",
     *      "mobile": "13800138000",
     *      "mobile_validated": "0",
     *      "oauth": "",
     *      "openid": null,
     *      "head_pic": "/Public/upload/head_pic/2015/12-28/56812d56854d0.jpg",
     *      "province": "19",
     *      "city": "236",
     *      "district": "2339",
     *      "email_validated": "1",
     *      "nickname": "的广泛地"
     *      "token": "9f3de86be794f81cdfa5ff3f30b99257"        // 用于 app 登录
     *      "paypoint": "0.00",
     *      "comment_count": 0,
     *      "order_count": 0,
     *      "star": 0
     *      "level_seller": 0       //特权等级
     *      "grade_seller": 0       //技能等级
     * }
     * }
     * @apiErrorExample {json}  Error-Response:
     *  Http/1.1
     *  {
     *      "status": -1,
     *      "msg": "请填写账号或密码",
     *      "result": ""
     *  }
     */
    public function getMine ()
    {
        $seller_info = M("seller") -> field("password",ture) ->where("seller_id = ".$this -> user_id) -> find();
        $order_count = M("pack_order") -> field("COUNT(pack_order) pack_order") ->where("seller_id = ".$this -> user_id) -> count();
        $comment_count = M("order_comment") -> field("COUNT(order_comment_id) comment") ->where("type = 3 AND user_id = ".$this -> user_id) -> count();
        $star_sum = M("order_comment") -> field("AVG(pack_order_score) star") ->where("type = 3 AND user_id = ".$this -> user_id) -> find();

//        print_r($star_sum);die;
        $seller_info["order_count"] = $order_count ? $order_count : 0;
        $seller_info["star"] = round($star_sum["star"]);
        $seller_info["comment_count"] = $comment_count["comment"] ? $comment_count["comment"] : 0;
        $seller_info["level"] = 1;

        $this->getAreaName($seller_info);
        jsonData(1,"返回成功", $seller_info);
    }

    public function getAreaName (&$userInfo)
    {
        $userInfo = (array)$userInfo;
        if($userInfo["country_id"])
        {
            $region_country = M("region_country") -> where("id = ".$userInfo["country_id"]) -> find();
            if(!$region_country)
                $userInfo["country_name"] = "";
            $userInfo["country_name"] = $region_country["name"];
        }else
        {
            $userInfo["country_name"] = "";
        }

        if($userInfo["province"])
        {
            $region_province = M("region") -> where("id = ".$userInfo["province"]) -> find();
            if(!$region_province)
                $userInfo["province_name"] = "";
            $userInfo["province_name"] = $region_province["name"];
        }else
            $userInfo["province_name"] = "";

        if($userInfo["city"])
        {
            $region_city = M("region") -> where("id = ".$userInfo["city"]) -> find();
            if(!$region_city)
                $userInfo["city_name"] = "";
            $userInfo["city_name"] = $region_city["name"];
        }else
            $userInfo["city_name"] = "";
    }

    /**
     * @api      {POST} /index.php?m=Api&c=User&a=updateInfo   更新用户信息done
     * @apiName  postUpdateInfo
     * @apiGroup User
     * @apiParam {String} token  token值
     * @apiParam {String} head_pic   头像
     * @apiParam {String} nickname   昵称
     * @apiParam {int} sex   性别 0 保密 1 男 2 女
     * @apiParam {String} language   语言
     * @apiParam {String} briefing   简介
     * @apiParam {String} img_url   多个用| 隔开
     * @apiParam {String} signature  签名
     * @apiParam {String} area   示例：{"country" : "1","province": "100","city": "200"}
     * @apiSuccessExample {json}    Success-Response:
     *  Http/1.1   200 OK
     * {
     *  "status": 1,
     *  "msg": "修改成功！",
     *  "result": {}
     *  }
     */
    /**
     * 更改用户信息
     */
    public function updateInfo()
    {
        model("common/users") -> updateUser($this -> user_id);
    }

    /**
     * @api      {POST} /index.php?m=Api&c=User&a=login     用户登录done
     * @apiName  login
     * @apiGroup User
     * @apiParam {String} username          用户名.
     * @apiParam {String} password          密码.
     * @apiParam {String} unique_id         手机端唯一标识 类似web pc端sessionid.
     * @apiParam {String} pushToken         消息推送token.
     * @apiParam {String} capache         图形验证码.
     * @apiParam {String} push_id         推送id，相当于第三方的reg_id.
     * @apiSuccessExample {json}    Success-Response:
     * Http/1.1   200 OK
     * {
     *   "status": 1,
     *   "msg": "登陆成功",
     *   "result": {
     *   "user_id": "1",
     *   "email": "398145059@qq.com",
     *   "password": "e10adc3949ba59abbe56e057f20f883e",
     *   "sex": "1",
     *   "birthday": "2015-12-30",
     *   "user_money": "9999.39",
     *   "frozen_money": "0.00",
     *   "pay_points": "5281",
     *   "address_id": "3",
     *   "reg_time": "1245048540",
     *   "last_login": "1444134213",
     *   "last_ip": "127.0.0.1",
     *   "qq": "3981450598",
     *   "mobile": "13800138000",
     *   "mobile_validated": "0",
     *   "oauth": "",
     *   "openid": null,
     *   "head_pic": "/Public/upload/head_pic/2015/12-28/56812d56854d0.jpg",
     *   "province": "19",
     *   "city": "236",
     *   "district": "2339",
     *   "email_validated": "1",
     *   "nickname": "的广泛地"
     *   "level_seller": 0       //特权等级
     *   "grade_seller": 0       //技能等级
     *
     *   "token": "9f3de86be794f81cdfa5ff3f30b99257"        // 用于 app 登录
     *   }
     *   }
     *    @apiErrorExample {json}  Error-Response:
     *    Http/1.1   404 NOT FOUND
     *   {
     *      "status": -1,
     *      "msg": "请填写账号或密码",
     *      "result": ""
     *   }
     */
    public function login()
    {
        $username = I('username', '');
        $password = I('password', '');
        $capache = I('capache', '');
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        $push_id = I('push_id', '');
        $data = $this->userLogic->app_login($username, $password, $capache, $push_id);
        $this->getAreaName($data["result"]);
        if($data['status'] != 1){
            $this->ajaxReturn($data);
        }

        $cartLogic = new CartLogic();
        $cartLogic->setUserId($data['result']['user_id']);
        $cartLogic->setUniqueId($unique_id);
        $cartLogic->doUserLoginHandle();  // 用户登录后 需要对购物车 一些操作
        $this->ajaxReturn($data);
    }

    /**
     * 登出
     */
    public function logout()
    {
        $token = I("post.token", '');
        $data = $this->userLogic->app_logout($token);
        $this->ajaxReturn($data);
    }

    /**
     * @api {POST}  index.php?m=Api&c=User&a=thirdLogin
     * @apiName     thirdLogin
     * @apiGroup    User
     * @apiParam    {String}      unique_id     第三方唯一标识
     * @apiParam    {String}      from          来源 wx weibo alipay
     * @apiParam    {String}      [nickname]    第三方返回昵称
     * @apiParam    {String}      [head_pic]    头像路径
     * @apiSuccessExample   {json}  Success-response
     *      Http/1.1    200 Ok
     * {
     * "status": 1,
     * "msg": "登陆成功",
     * "result": {
     * "user_id": "12",
     * "email": "",
     * "password": "",
     * "sex": "0",
     * "birthday": "0000-00-00",
     * "user_money": "0.00",
     * "frozen_money": "0.00",
     * "pay_points": "0",
     * "address_id": "0",
     * "reg_time": "1452331498",
     * "last_login": "0",
     * "last_ip": "",
     * "qq": "",
     * "mobile": "",
     * "mobile_validated": "0",
     * "oauth": "wx",
     * "openid": "2",
     * "head_pic": null,
     * "province": "0",
     * "city": "0",
     * "district": "0",
     * "email_validated": "0",
     * "nickname": ""
     * }
     * }
     * @apiErrorExample     {json}  Error-response
     *              Http/1.1    200 OK
     *   {
    "status": -1,
    "msg": "参数有误",
    "result": ""
    }
     */
    public function thirdLogin(){
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        $map['openid'] = I('openid','');
        $map['oauth'] = I('from','');
        $map['nickname'] = I('nickname','');
        $map['head_pic'] = I('head_pic','');
        $map['unionid'] = I('unionid','');
        $map['push_id'] = I('push_id','');
        $map['sex'] = I('sex', 0);

        if ($map['oauth'] == 'miniapp') {
            $code = I('post.code', '');
            if (!$code) {
                $this->ajaxReturn(['status' => -1, 'msg' => 'code值非空']);
            }

            $miniapp = new \app\common\logic\MiniAppLogic;
            $session = $miniapp->getSessionInfo($code);
            if ($session === false) {
                $this->ajaxReturn(['status' => -1, 'msg' => $miniapp->getError()]);
            }
            $map['openid'] = $session['openid'];
            $map['unionid'] = $session['unionid'];
        }

        $data = $this->userLogic->thirdLogin($map);
        if($data['status'] == 1){
            $cartLogic = new CartLogic();
            $cartLogic->setUserId($data['result']['user_id']);
            $cartLogic->setUniqueId($unique_id);
            $cartLogic->doUserLoginHandle();// 用户登录后 需要对购物车 一些操作
            //重新获取用户信息，补全数据
            $data = $this->userLogic->getApiUserInfo($data['result']['user_id']);
        }
        $this->ajaxReturn($data);
    }

    /**
     * @api     {POST} /index.php?m=Api&c=User&a=reg            用户注册
     * @apiName   reg
     * @apiGroup  User
     * @apiParam {String} country_code     国家区号
     * @apiParam {String} username         手机号/用户名.
     * @apiParam {String} password         密码
     * @apiParam {String} [code]           手机短信验证码
     * @apiParam {String} [push_id]        推送id，相当于第三方的reg_id
     * @apiSuccessExample {json} Success-Response:
     *   HTTP/1.1 200 OK
     *  {
     *      "status": 1,
     *      "msg": "注册成功",
     *      "result": {
     *      "user_id": 146,
     *      "email": "",
     *      "password": "90600d68b0f56d90c4c34284d8dfd138",
     *      "sex": 0,
     *      "birthday": 0,
     *      "user_money": "0.00",
     *      "frozen_money": "0.00",
     *      "distribut_money": "0.00",
     *      "pay_points": "0.0000",
     *      "address_id": 0,
     *      "reg_time": 1504596640,
     *      "last_login": 1504596640,
     *      "last_ip": "",
     *      "qq": "",
     *      "mobile": "18451847701",
     *      "mobile_validated": 1,
     *      "oauth": "",
     *      "openid": null,
     *      "unionid": null,
     *      "head_pic": null,
     *      "province": 0,
     *      "city": 0,
     *      "district": 0,
     *      "email_validated": 0,
     *      "nickname": "18451847701",
     *      "level": 1,
     *      "discount": "1.00",
     *      "total_amount": "0.00",
     *      "is_lock": 0,
     *      "is_distribut": 1,
     *      "first_leader": 0,
     *      "second_leader": 0,
     *      "third_leader": 0,
     *      "fourth_leader": null,
     *      "fifth_leader": null,
     *      "sixth_leader": null,
     *      "seventh_leader": null,
     *      "token": "c34ba58aec24003f0abec19ae2688c86",
     *      "address": null,
     *      "pay_passwd": null,
     *      "pre_pay_points": "0.0000",
     *      "optional": "0.0000",
     *      "vipid": 0,
     *      "paypoint": "0.00"
     *  }
     *  }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
    {
    "status": -1,
    "msg": "账号已存在",
    "result": ""
    }
     */
    public function reg(){
        $username = I('post.username','');
        $password = I('post.password','');
        $country_code = I('post.country_code',0);
        $apply_code = I('post.apply_code',0);
        if(!$country_code)
            dataJson(4004,"国家区号不能为空！",[]);

        $code = I('post.code');
        $type = I('type','phone');
        $session_id = I('unique_id', session_id());// 唯一id  类似于 pc 端的session id
        $scene = I('scene' , 1);
        $push_id = I('post.push_id' , '');


        if(model("common/Sms") -> checkSms(1,$country_code.$username,$code))
        {
            $data = $this -> userLogic -> reg($username,$password , $password, $push_id,$country_code,$apply_code);
            exit(json_encode($data));
        }
    }

    public function reg2(){
        $username = I('post.username','');
        $password = I('post.password','');
        $up_apply_code = I('post.apply_code',0);
        $country_code = I('post.country_code',0);
        if(!$password)
            dataJson(4004,"密码不能为空！",[]);

        if(!$country_code)
            dataJson(4004,"国家区号不能为空！",[]);

        $password = md5("TPSHOP".$password);

        $code = I('post.code');
        $type = I('type','phone');
        $session_id = I('unique_id', session_id());// 唯一id  类似于 pc 端的session id
        $scene = I('scene' , 1);
        $push_id = I('post.push_id' , '');


        if(model("common/Sms") -> checkSms(1,$country_code.$username,$code))
        {
            $data = $this->userLogic->reg($username,$password , $password, $push_id,$country_code,$up_apply_code);
            exit(json_encode($data));
        }
    }
//    public function updateUserInfo(){
//        if(IS_POST){
//            //$user_id = I('user_id/d');
//            if(!$this->user_id)
//                exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
//
//            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
//            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
//            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
//            I('post.sex') ? $post['sex'] = I('post.sex') : false;  // 性别
//            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
//            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
//            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
//            I('post.district') ? $post['district'] = I('post.district') : false;  //地区
//            I('post.email') ? $post['email'] = I('post.email') : false;
//            I('post.mobile') ? $post['mobile'] = I('post.mobile') : false;
//
//            if(!$this->userLogic->update_info($this->user_id,$post))
//                exit(json_encode(array('status'=>-1,'msg'=>'更新失败','result'=>'')));
//            exit(json_encode(array('status'=>1,'msg'=>'更新成功','result'=>'')));
//
//        }
//    }

    public function forgetPasswordInfo()
    {
        $account = I('post.account', '');
        $capache = I('post.capache' , '');
        if (!capache([], SESSION_ID, $capache)) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'验证码错误！']);
        }
        if (($user = M('users')->field('mobile, nickname')->where(['mobile' => $account])->find())
            || ($user = M('users')->field('mobile, nickname')->where(['email' => $account])->find())
            || ($user = M('users')->field('mobile, nickname')->where(['nickname' => $account])->find())) {
            $this->ajaxReturn(['status'=>1, 'msg'=>'获取成功', 'result' => $user]);
        }
        if (!$user) {
            $this->ajaxReturn(['status'=>-1, 'msg'=>'该账户不存在']);
        }
    }

    /**
     * 短信验证
     */
    public function check_sms()
    {
        $mobile = I('post.mobile');
        $unique_id = I('unique_id');
        $code = I('post.check_code');   //验证码
        $scene = I('post.scene/d', 2);   //验证码
        if (!check_mobile($mobile)) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'手机号码格式不正确','result'=>'']);
        }

        $res = $this->userLogic->check_validate_code($code, $mobile, 'phone', $unique_id , $scene);
        if ($res['status'] != 1) {
            $this->ajaxReturn($res);
        }

        $this->ajaxReturn(['status'=>1, 'msg'=>'验证成功']);
    }

    /**
     * 修改手机验证
     */
    public function change_mobile()
    {
        $mobile = I('post.mobile');
        $unique_id = I('unique_id');
        $code = I('post.check_code');   //验证码
        $scene = I('post.scene/d', 0);   //验证码
        $capache = I('post.capache' , '');
        if (!check_mobile($mobile)) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'手机号码格式不正确','result'=>'']);
        }

        $res = $this->userLogic->check_validate_code($code, $mobile, 'phone', $unique_id , $scene);
        if ($res['status'] != 1) {
            $this->ajaxReturn($res);
        }

        /* if (!capache([], SESSION_ID, $capache)) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'图形验证码错误！']);
        } */

        if ($scene != 6) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'场景码错误！']);
        }

        $data['mobile'] = $mobile;
        if (!$this->userLogic->update_info($this->user_id, $data)) {
            $this->ajaxReturn(['status' => -1, 'msg' => '手机号码更新失败']);
        }

        $this->ajaxReturn(['status'=>1, 'msg'=>'更改成功']);
    }


    /**
     * @api      {POST} index.php?m=Api&c=User&a=forgetPassword   忘记密码done
     * @apiName  forgetPassword
     * @apiGroup User
     * @apiSuccessExample {json} Success-Response:
     *           Http/1.1   200 OK
    {
    "status": 1,
    "msg": "密码已重置,请重新登录",
    }
     */
    public function forgetPassword()
    {
        $code = I('code');
        $password = I('password');
        $mobile = I('mobile', 'invalid');
        //$consignee = I('consignee', '');

        $user = M('seller')->where("mobile",$mobile)->find();

        if (!$user) {
            $this->ajaxReturn(['status'=>-1,'msg'=>'该手机号码没有关联账户']);
        } else {
            //校验验证码
//            $result = MsgService::verifyCaptcha($mobile,'resetpwd',$code);
            if(model("common/Sms") -> checkSms(1,$user["country_code"].$mobile,$code))
            {
                if($user['password'] == $password){
                    $this->ajaxReturn(['status'=>-1,'msg'=>'新密码与原密码不能一样']);
                }
                $easemobUse = new  \emchat\EasemobUse();
                $hx_user = md5($mobile);
                $easemobUse -> setUserName($hx_user);
                $easemobUse -> setPassword($password);
                $easemobUse -> resetPassword();

                //修改密码
                M('seller')->where("seller_id",$user['seller_id'])->save(array('password'=>$password));
                $this->ajaxReturn(['status'=>1,'msg'=>'密码已重置,请重新登录']);
            }

        }
    }

    /**
     * 获取收货地址
     */
    public function getAddressList()
    {
        if (!$this->user_id) {
            $this->ajaxReturn(array('status'=>-1,'msg'=>'缺少参数'));
        }

        $address = M('user_address')->where(array('user_id'=>$this->user_id))->select();
        if(!$address) {
            $this->ajaxReturn(array('status'=>1,'msg'=>'没有数据','result'=>[]));
        }

        $regions = M('region')->cache(true)->getField('id,name');
        foreach ($address as &$addr) {
            $addr['province_name'] = $regions[$addr['province']] ?: '';
            $addr['city_name']     = $regions[$addr['city']] ?: '';
            $addr['district_name'] = $regions[$addr['district']] ?: '';
            $addr['twon_name']     = $regions[$addr['twon']] ?: '';
            $addr['address']       = $addr['address'] ?: '';
        }

        $this->ajaxReturn(array('status'=>1,'msg'=>'获取成功','result'=>$address));
    }

    /*
     * 添加地址
     */
    public function addAddress(){
        //$user_id = I('user_id/d',0);
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address_id = I('address_id/d',0);
        $data = $this->userLogic->add_address($this->user_id,$address_id,I('post.')); // 获取用户信息
        exit(json_encode($data));
    }
    /*
     * 地址删除
     */
    public function del_address(){
        $id = I('id/d');
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address = M('user_address')->where("address_id" ,$id)->find();
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->delete();

        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if($address['is_default'] == 1)
        {
            $address = M('user_address')->where("user_id",$this->user_id)->find();

            //@mobify by wangqh {
            if($address) {
                M('user_address')->where("address_id",$address['address_id'])->save(array('is_default'=>1));
            }//@}

        }

        //@mobify by wangqh
        if ($row)
            exit(json_encode(array('status'=>1,'msg'=>'删除成功','result'=>'')));
        else
            exit(json_encode(array('status'=>1,'msg'=>'删除失败','result'=>'')));
    }

    /*
     * 设置默认收货地址
     */
    public function setDefaultAddress() {
//        $user_id = I('user_id/d',0);
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address_id = I('address_id/d',0);
        $data = $this->userLogic->set_default($this->user_id,$address_id); // 获取用户信息
        if(!$data)
            exit(json_encode(array('status'=>-1,'msg'=>'操作失败','result'=>'')));
        exit(json_encode(array('status'=>1,'msg'=>'操作成功','result'=>'')));
    }

    /*
     * 获取优惠券列表
     */
    public function getCouponList()
    {
        if (!$this->user_id) {
            $this->ajaxReturn(['status'=>-1, 'msg'=>'还没登录', 'result'=>'']);
        }

        $store_id = I('get.store_id', 0);
        $type = I('get.type', 0);
        $order_money = I('get.order_money', 0);

        $data = $this->userLogic->get_coupon($this->user_id, $type, null, 0, $store_id, $order_money);
        unset($data['show']);

        /* 获取各个优惠券的平台 */
        $coupon_list = &$data['result'];
        $store_id_arr = get_arr_column($coupon_list, 'store_id');
        $store_arr = M('store')->where('store_id', 'in', $store_id_arr)->getField('store_id,store_name,store_logo');
        foreach ($coupon_list as &$coupon) {
            if ($coupon['store_id'] > 0) {
                $coupon['limit_store'] = $store_arr[$coupon['store_id']]['store_name'];
            } else {
                $coupon['limit_store'] = '全平台';
            }
        }

        $this->ajaxReturn($data);
    }

    /**
     * 获取购物车指定店铺的优惠券
     */
    public function cart_coupons()
    {
        $store_id = I('store_id/d' , 0);    //限制店铺
        $money = I('money/f' , 0);        //限制金额

        $cartLogic = new CartLogic();
        $couponLogic = new CouponLogic();
        $cartLogic->setUserId($this->user_id);
        if ($cartLogic->getUserCartOrderCount() == 0){
            $this->ajaxReturn(['status' => -1, 'msg' => '你的购物车没有选中商品']);
        }
        $cartList = $cartLogic->getCartList(1); // 获取用户选中的购物车商品

        $cartGoodsList = get_arr_column($cartList,'goods');
        $cartGoodsId = get_arr_column($cartGoodsList,'goods_id');
        $cartGoodsCatId = get_arr_column($cartGoodsList,'cat_id3');
        //$storeCartList = $cartLogic->getStoreCartList($cartList);//转换成带店铺数据的购物车商品

        $userCouponList = $couponLogic->getUserAbleCouponList($this->user_id, $cartGoodsId, $cartGoodsCatId);//用户可用的优惠券列表

        $store_id_arr = get_arr_column($userCouponList, 'store_id');
        $store_arr = M('store')->where('store_id', 'in', $store_id_arr)->getField('store_id,store_name,store_logo');

        $returnCouponList = array();
        foreach ($userCouponList as $k => $v){
            if($v['store_id'] ==0 || $v['store_id'] == $store_id){
                $coupon = $v['coupon'];

                if($coupon){
                    if($money == 0  || ($money > 0 && $coupon['condition'] <  $money)){      //金额限制
                        $coupon['limit_store'] = $store_arr[$coupon['store_id']]['store_name'];
                        switch ($coupon['use_type']){//0全店通用1指定商品可用2指定分类商品可用
                            case 0 :
                                $returnCoupon['limit_store'] = $coupon['limit_store'].'全店通用';
                                break;
                            case 1 :
                                $returnCoupon['limit_store'] = $coupon['limit_store'].'指定商品可用';
                                break;
                            case 2 :
                                $returnCoupon['limit_store'] = $coupon['limit_store'].'指定分类商品可用';
                                break;
                            case 3 :
                                $returnCoupon['limit_store'] = '全平台可用';
                                break;
                        }
                        $returnCoupon['id'] = $v['id'];
                        $returnCoupon['name'] = $coupon['name'];
                        $returnCoupon['money'] = $coupon['money'];
                        $returnCoupon['condition'] = $coupon['condition'];
                        $returnCoupon['use_start_time'] = $coupon['use_start_time'];
                        $returnCoupon['use_end_time'] = $coupon['use_end_time'];
                        $returnCoupon['store_id'] = $v['store_id'];
                        $returnCouponList[] = $returnCoupon;
                    }
                }
            }
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $returnCouponList]);
    }

    /*
     * 获取商品收藏列表
     */
    public function getGoodsCollect()
    {
        $data = $this->userLogic->get_goods_collect($this->user_id);
        unset($data['show']);
        unset($data['page']);
        $this->ajaxReturn($data);
    }

    /*
     * 用户订单列表
     */
    public function getOrderList()
    {
        $type = I('type','');
        $p = I('p', 1);
        if (!$this->user_id) {
            $this->ajaxReturn(['status'=>-1, 'msg'=>'缺少参数', 'result'=>'']);
        }

        $map = " deleted = 0 AND user_id = :user_id";
        $map = $type ? $map.C($type) : $map;

        $order_list = [];
        $order_obj = new \app\common\model\Order();
        $order_list_obj = $order_obj->order("order_id DESC")->where($map)->bind(['user_id'=>$this->user_id])->page($p, 10)->select();
        if ($order_list_obj) {
            //转为数字，并获取订单状态，订单状态显示按钮，订单商品
            $order_list=collection($order_list_obj)->append(['order_status_detail','order_button','order_goods','store'])->toArray();
        }

        $this->ajaxReturn(['status'=>1,'msg'=>'获取成功','result'=>$order_list]);
    }

    /**
     * 取消订单
     */
    public function cancelOrder(){
        $id = I('order_id/d');
//        $user_id = I('user_id/d',0);
        $logic = new OrderLogic();
        if(!$this->user_id > 0 || !$id > 0)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        $data = $logic->cancel_order($this->user_id,$id);
        exit(json_encode($data));
    }

    /**
     *  收货确认
     */
    public function orderConfirm(){
        $id = I('order_id/d',0);
        //$user_id = I('user_id/d',0);
        if(!$this->user_id || !$id)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        $data = confirm_order($id,$this->user_id);
        exit(json_encode($data));
    }


    /*
     *添加评论
     */
    public function add_comment()
    {
        $data['order_id']         = input('post.order_id/d', 0);
        $data['rec_id']           = input('post.rec_id/d', 0);
        $data['goods_id']         = input('post.goods_id/d', 0);
        $data['pack_order_score']     = input('post.service_rank', 0);   //卖家服务分数（0~5）(order_comment表)
        $data['logistics_score']  = input('post.deliver_rank', 0); //物流服务分数（0~5）(order_comment表)
        $data['describe_score']   = input('post.goods_rank', 0);  //描述服务分数（0~5）(order_comment表)
        $data['goods_rank']       = input('post.goods_score/d', 0);   //商品评价等级
        $data['is_anonymous']     = input('post.is_anonymous/d', 0);
        $data['content']          = input('post.content', '');
        $data['img']              = input('post.img/a', ''); //小程序需要
        $data['user_id']          = $this->user_id;

        $commentLogic = new CommentLogic;
        $return = $commentLogic->addGoodsAndServiceComment($data);

        $this->ajaxReturn($return);
    }

    /**
     * 提交服务评论
     */
    public function add_service_comment()
    {
        $order_id = I('post.order_id/d', 0);
        $service_rank = I('post.service_rank', 0);
        $deliver_rank = I('post.deliver_rank', 0);
        $goods_rank = I('post.goods_rank', 0);

        $store_id = M('order')->where(array('order_id' => $order_id))->getField('store_id');

        $commentLogic = new CommentLogic;
        $return = $commentLogic->addServiceComment($this->user_id, $order_id, $store_id, $service_rank, $deliver_rank, $goods_rank);

        $this->ajaxReturn($return);
    }

    /**
     * 上传头像
     */
    public function upload_headpic()
    {
        $userLogic = new UsersLogic();

        $return = $userLogic->upload_headpic(true);
        if ($return['status'] !== 1) {
            $this->ajaxReturn($return);
        }
        $post['head_pic'] = $return['result'];

        if (!$userLogic->update_info($this->user_id, $post)) {
            $this->ajaxReturn(['status' => -1, 'msg' => '保存失败']);
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '操作成功', 'result' => $post['head_pic']]);
    }

    /*
     * 账户资金
     */
    public function account(){

        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        // $user_id = I('user_id/d'); // 用户id
        //获取账户资金记录

        $data = $this->userLogic->get_account_log($this->user_id,I('get.type'));
        $account_log = $data['result'];
        exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$account_log)));
    }

    /**
     * 申请退货状态
     */
    public function return_goods_status()
    {
        $rec_id = I('rec_id','');

        $return_goods = M('return_goods')
            ->where(['rec_id'=>$rec_id])
            ->where('status','in','0,1')
            ->find();

        //判断是否超过退货期
        $order = M('order')->where('order_id',$return_goods['order_id'])->find();
        $confirm_time_config = tpCache('shopping.auto_service_date');//后台设置多少天内可申请售后
        $confirm_time = $confirm_time_config * 24 * 60 * 60;
        if ($order && (time() - $order['confirm_time']) > $confirm_time && !empty($order['confirm_time'])) {
            return ['result'=>-1,'msg'=>'已经超过' . ($confirm_time_config ?: 0) . "天内退货时间"];
        }

        $return_id = $return_goods ? $return_goods['id'] : 0; //1代表可以退换货
        $this->ajaxReturn(['status'=>1, 'msg'=>'获取成功',  'result' => $return_id]);
    }

    /**
     * 获取收藏店铺列表集合, 只用于查询用户收藏的店铺, 页面判断用, 区别于getUserCollectStore
     */
    public function getCollectStoreData()
    {
        $where = array('user_id' => $this->user_id);
        $storeCollects = M('store_collect')->where($where)->select();
        $json_arr = array('status' => 1, 'msg' => '获取成功', 'result' => $storeCollects);
        exit(json_encode($json_arr));
    }

    /**
     * @author dyr
     * 获取用户收藏店铺列表
     */
    public function getUserCollectStore()
    {
        $page = I('page', 1);
        $storeLogic = new StoreLogic();
        $store_list = $storeLogic->getUserCollectStore($this->user_id,$page,10);
        $json_arr = array('status' => 1, 'msg' => '获取成功', 'result' => $store_list);
        exit(json_encode($json_arr));
    }

    /**
     * 申请提现记录列表网页
     * @return type
     */
    public function withdrawals_list()
    {
        $is_json = I('is_json', 0); //json数据请求
        $withdrawals_where['user_id'] = $this->user_id;
        $count = M('withdrawals')->where($withdrawals_where)->count();
        $pagesize = C('PAGESIZE') == 0 ? 10 : C('PAGESIZE');
        $page = new Page($count, $pagesize);
        $list = M('withdrawals')->where($withdrawals_where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();

        if ($is_json) {
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $list]);
        }

        $this->assign('page', $page->show());// 赋值分页输出
        $this->assign('list', $list); // 下线
        if (I('is_ajax')) {
            return $this->fetch('ajax_withdrawals_list');
        }
        return $this->fetch();
    }

    /**
     * 申请提现
     */
    public function withdrawals()
    {
        $data = I('post.');
        if (!capache([], SESSION_ID, $data['verify_code'])) {
            $this->ajaxReturn(['status' => -1, 'msg' => "验证码错误"]);
        }

        $data['user_id'] = $this->user_id;
        $data['create_time'] = time();
        $distribut_min = tpCache('basic.min'); // 最少提现额度
        $distribut_need  = tpCache('basic.need'); //满多少才能提
        if ($data['money'] < $distribut_min) {
            $this->ajaxReturn(['status' => -1, 'msg' => '每次最少提现额度'.$distribut_min]);
        }
        if ($data['money'] > $this->user['user_money']) {
            $this->ajaxReturn(['status' => -1, 'msg' => "你最多可提现{$this->user['user_money']}账户余额."]);
        }
        if ($this->user['user_money']<$distribut_need) {
            $this->ajaxReturn(['status' => -1, 'msg' => '账户余额最少达到'.$distribut_need.'才能提现']);
        }

        $withdrawal = M('withdrawals')->where(array('user_id'=>$this->user_id,'status'=>0))->sum('money');
        if ($this->user['user_money'] < ($withdrawal+$data['money'])){
            $this->ajaxReturn(['status' => -1, 'msg' => '您有提现申请待处理，本次提现余额不足']);
        }
        if (M('withdrawals')->add($data)) {
            $bank['bank_name'] = $data['bank_name'];
            $bank['bank_card'] = $data['account_bank'];
            $bank['realname'] = $data['account_name'];
            M('users')->where(array('user_id'=>$this->user_id))->save($bank);
            $json_arr = array('status' => 1, 'msg' => '提交成功');
        } else {
            $json_arr = array('status' => -1, 'msg' => '提交失败,联系客服!');
        }
        $this->ajaxReturn($json_arr);
    }

    /**
     * 账户明细
     */
    public function points()
    {
        $type = I('type','all');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->points($this->user_id, $type);

        $json_arr = ['status' => 1, 'msg' => '获取成功', 'result' => $result['account_log']];
        exit(json_encode($json_arr));
    }

    /**
     * 验证码获取
     */
    public function verify()
    {
        $type = I('get.type') ?: SESSION_ID;
        $is_image = I('get.is_image', 0);
        if (!$is_image) {
            $result = capache([], $type);
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result]);
        }

        $config = array(
            'fontSize' => 30,
            'length' => 4,
            'imageH' =>  60,
            'imageW' =>  300,
            'fontttf' => '5.ttf',
            'useCurve' => true,
            'useNoise' => false,
            'length'   => 4,
        );
        $Verify = new \think\Verify($config);
        $Verify->entry($type);
        exit;
    }

    /**
     * 评论列表
     */
    public function comment()
    {
        $status = I('get.status', 0);
        $logic = new CommentLogic;
        $result = $logic->getComment($this->user_id, $status);

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result['result']]);
    }

    /**
     * 服务评论列表
     */
    public function service_comment()
    {
        $p = input('p', 1);
        $logic = new CommentLogic;
        $result = $logic->getServiceComment($this->user_id, $p);

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result]);
    }

    public function comment_num()
    {
        $logic = new CommentLogic;
        $result = $logic->getAllTypeCommentNum($this->user_id);

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result]);
    }

    /**
     * 浏览记录
     */
    public function visit_log()
    {
        $p = I('get.p', 1);

        $user_logic = new UsersLogic;
        $visit_list = $user_logic->visit_log($this->user_id, $p);

        $list = [];
        foreach ($visit_list as $k => $v) {
            $list[] = ['date' => $k, 'visit' => $v];
        }

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $list]);
    }

    /**
     * 删除浏览记录
     */
    public function del_visit_log()
    {
        $visit_ids = I('get.visit_ids', 0);
        $row = M('goods_visit')->where('visit_id','IN', $visit_ids)->delete();
        if (!$row) {
            $this->ajaxReturn(['status' => -1, 'msg' => '删除失败']);
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '删除成功']);
    }

    /**
     * 清空浏览记录
     */
    public function clear_visit_log()
    {
        $row = M('goods_visit')->where('user_id', $this->user_id)->delete();
        if(!$row) {
            $this->ajaxReturn(['status' => -1, 'msg' => '删除失败']);
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '删除成功']);
    }

    /**
     *  获取用户消息通知
     */
    public function message_notice()
    {
        $messageModel = new \app\common\logic\MessageLogic;
        $messages = $messageModel->getUserPerTypeLastMessage();

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $messages]);
    }

    /**
     * 获取消息
     */
    public function message()
    {
        $p = I('get.p', 1);
        $category = I('get.category', 0);

        $messageModel = new \app\common\logic\MessageLogic;
        $message = $messageModel->getUserMessageList($this->user_id, $category, $p);

        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $message]);
    }

    /**
     * 消息开关
     */
    public function message_switch()
    {
        if (!$this->user) {
            $this->ajaxReturn(['status' => -1, 'msg' => '用户不存在']);
        }

        $messageModel = new \app\common\logic\MessageLogic;

        if (request()->isGet()) {
            /* 获取消息开关 */
            $notice = $messageModel->getMessageSwitch($this->user['message_mask']);
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $notice]);
        } elseif (request()->isPost()) {
            /* 设置消息开关 */
            $type = I('post.type/d', 0); //开关类型
            $val = I('post.val', 0); //开关值
            $return = $messageModel->setMessageSwitch($type, $val, $this->user);
            $this->ajaxReturn($return);
        }

        $this->ajaxReturn(['status' => -1, 'msg' => '请求方式错误']);
    }

    /**
     * 清除消息
     */
    public function clear_message()
    {
        if (!$this->user_id) {
            $this->ajaxReturn(['status' => -1, 'msg' => '用户不存在']);
        }

        $messageModel = new \app\common\logic\MessageLogic;
        $messageModel->setMessageRead($this->user_id);

        $this->ajaxReturn(['status' => 1, 'msg' => '清除成功']);
    }

    /**
     * 账户明细列表网页
     * @return type
     */
    public function account_list()
    {
        $type = I('type','all');
        $is_json = I('is_json', 0); //json数据请求
        $usersLogic = new UsersLogic;
        $result = $usersLogic->account($this->user_id, $type);

        if ($is_json) {
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result['account_log']]);
        }

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if (I('is_ajax')) {
            return $this->fetch('ajax_acount_list');
        }
        return $this->fetch();
    }

    /**
     * 积分类别网络
     * @return type
     */
    public function points_list()
    {
        $type = I('type','all');
        $is_json = I('is_json', 0); //json数据请求
        $usersLogic = new UsersLogic;
        $result = $usersLogic->points($this->user_id, $type);

        if ($is_json) {
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result['account_log']]);
        }

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if (I('is_ajax')) {
            return $this->fetch('ajax_points');
        }
        return $this->fetch();
    }

    /**
     * @api {POST}  /index.php?m=Api&c=User&a=getWithdrawalList  获取提现列表done
     * @apiName     GetWithdrawalList
     * @apiGroup    Mine
     * @apiParam    token  token值
     * @apiParam    pagesize  每页条数
     * @apiParam    page  页数
     * @apiSuccess  status 状态：-2删除作废-1审核失败0申请中1审核通过2已转款完成
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *     "status": 1,
     *     "msg": "返回成功！",
     *     "result": []
     *  }
     */
    //获取提现列表
    public function getWithdrawalList()
    {
        model("common/Users") -> getWithdrawalList($this -> user_id);
    }

    /**
     * 充值记录网页
     * @return type
     */
    public function recharge_list()
    {
        $is_json = I('is_json', 0); //json数据请求
        $usersLogic = new UsersLogic;
        $result= $usersLogic->get_recharge_log($this->user_id);  //充值记录

        if ($is_json) {
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $result['result']]);
        }

        $this->assign('page', $result['show']);
        $this->assign('lists', $result['result']);
        if (I('is_ajax')) {
            return $this->fetch('ajax_recharge_list');
        }
        return $this->fetch();
    }

    /**
     * 物流网页
     * @return type
     */
    public function express()
    {
        $is_json = I('is_json', 0);
        $order_id = I('get.order_id/d', 0);
        $order_goods = M('order_goods')->where("order_id" , $order_id)->select();
        $delivery = M('delivery_doc')->where("order_id" , $order_id)->limit(1)->find();
        if ($is_json) {
            $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $delivery]);
        }
        $this->assign('order_goods', $order_goods);
        $this->assign('delivery', $delivery);
        return $this->fetch();
    }

    /**
     * 获取全部地址信息, 从BaseController移入到UserController @modify by wangqh.
     */
    public function allAddress(){
        $data =  M('region')->where('level < 4')->select();
        $json_arr = array('status'=>1,'msg'=>'成功!','result'=>$data);
        $json_str = json_encode($json_arr);
        exit($json_str);
    }

    /**
     * 关于我们页面
     */
    public function about_us()
    {
        return $this->fetch();
    }

    /**
     * 检查token状态
     */
    public function token_status()
    {
        $token = I('token/s', '');
        $return = $this->getUserByToken($token);
        if ($return['status'] == 1) {
            $return['result'] = '';
        }
        $this->ajaxReturn($return);
    }

    /**
     * 上传评论图片，小程序图片只能一张一张传
     */
    public function upload_comment_img()
    {
        $logic = new \app\common\logic\CommentLogic;
        $img = $logic->uploadCommentImgFile('comment_img_file');

        if ($img['status'] === 1) {
            $img['result'] = implode(',', $img['result']);
        }

        $this->ajaxReturn($img);
    }

    /**
     * 消息列表（小程序临时接口by lhb）
     * @author dyr
     * @time 2016/09/01
     */
    public function message_list()
    {
        $type = I('type', 0);
        $user_logic = new UsersLogic();
        $message_model = new \app\common\logic\MessageLogic();
        if ($type == 1) {
            //系统消息
            $user_sys_message = $message_model->getUserMessageNotice();
            //$user_logic->setSysMessageForRead();
        } else if ($type == 2) {
            //活动消息：后续开发
            $user_sys_message = array();
        } else {
            //全部消息：后续完善
            $user_sys_message = $message_model->getUserMessageNotice();
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $user_sys_message]);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=User&a=suggestion_type&limit=   获取意见反馈类型done
     * @apiName     suggestion_type
     * @apiGroup    Suggestion
     * @apiParam {string} limit 显示条数
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功！",
     *      "result": [
     *      "功能异常",
     *      "体验问题",
     *      "新功能建议",
     *      "其他"
     *       ]
     *  }
     */
    public function suggestion_type ()
    {
        model("common/Users") -> suggestion_type();
    }
    /**
     * @api {POST}  /index.php?m=Api&c=User&a=suggestionFeedback   意见反馈done
     * @apiName     SuggestionFeedback
     * @apiGroup    Suggestion
     * @apiParam     suggest_id  意见类型id
     * @apiParam    content  要反馈的内容
     * @apiParam    img_url  图片url
     * @apiParam    token  token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "申请成功！",
     *      "result": {}
     * }
     */
    public function suggestionFeedback ()
    {
        model("common/Users") -> suggestionFeedback($this->user_id);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=User&a=updateMobile  【更换手机号】新手机修改done
     * @apiName     UpdateMobile
     * @apiGroup    User
     * @apiParam     username  手机号码【区号必须】
     * @apiParam    country_code  区号
     * @apiParam    code  验证码
     * @apiParam    token  token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "验证成功！",
     *      "result": []
     * }
     */
    public function updateMobile ()
    {
        model("common/Users") -> updateMobile($this->user_id);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=User&a=checkSms  【更换手机号】验证原手机号done
     * @apiName     UserCheckSms
     * @apiGroup    User
     * @apiParam     username  手机号码【不带区号】
     * @apiParam    code  验证码
     * @apiParam    token  token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "验证成功！",
     *      "result": []
     * }
     */
    public function checkSms ()
    {
        model("common/Users") -> checkSms( $this->user_id );
    }

    /**
     * 申请提现
     */
    public function driveWithdrawals ()
    {
        model("common/Users") -> driveWithdrawals($this->user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=User&a=getWithdrawals  获取提现金额done
     * @apiName     GetWithdrawals
     * @apiGroup    Mine
     * @apiParam    token  token值
     * @apiSuccess  status 状态：-2删除作废-1审核失败0申请中1审核通过2已转款完成
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *          "seller_id": 20,
     *          "drv_money": 100
     *      }
     *  }
     */
    /**
     * 获取提现
     */
    public function getWithdrawals ()
    {
        model("common/Users") -> getWithdrawal($this -> user_id);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=User&a=postWithdrawals  提交提现申请done
     * @apiName     PostWithdrawals
     * @apiGroup    Mine
     * @apiParam    token  token值
     * @apiParam    money  提现金额
     * @apiParam    distill_way  提现方式
     * @apiParam    account  提现账户
     * @apiParam    account_name  提现人用户名
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *     "status": 1,
     *     "msg": "返回成功！",
     *     "result": []
     *  }
     */
    /**
     * 获取提现
     */
    public function postWithdrawals ()
    {
        model("common/Users") -> driveWithdrawals($this->user_id);
    }

    /**
     * @api {GET}    /index.php?m=Api&c=User&a=getHxSingleUser  获取环信单个用户信息done
     * @apiName     GetHxSingleUser
     * @apiGroup    Mine
     * @apiParam    token  token值
     * @apiParam    hx_user  环信用户名

     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *     "status": 1,
     *     "msg": "返回成功！",
     *     "result": []
     *  }
     */
    /**
     * 获取提现
     */
    public function getHxSingleUser ()
    {
        model("common/Users") -> getHxSingleUser();
    }

    /**
     * @api {POST}    /index.php?m=Api&c=User&a=getSellerHx  获取环信用户done
     * @apiName     GetSellerHx
     * @apiGroup    Mine
     * @apiParam    token  token值

     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     *{
     *  "status": 1,
     *  "msg": "返回成功",
     *  "result": {
     *      "nickname": "13222222222",
     *      "head_pic": "112354521412",
     *      "hx_user_name": "d53fa014dabdff84cf9d616b8cc1fabf"
     *  }
     *  }
     */
    /**
     * 根据seller_id获取环信用户
     */
    public function getSellerHx ()
    {
        model("common/Users") -> getSellerHxName();
    }

    public function register_html()
    {
        $result = M("country_mobile_prefix") -> select();
        $this->assign("country_code", $result);
        return $this -> fetch("register");
    }

    public function reg_success()
    {
        return $this -> fetch("Registration_Successful");
    }
}
