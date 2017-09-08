<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导控制器
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

class Pack extends Base {
    public function _initialize ()
    {
         $this -> ruit_pack_driver_apply = M("ruit_pack_driver_apply");
         $this -> seller = M("seller");

    }
    /**
     * @api {GET}   /index.php?m=Api&c=Pack&a=index     司导首页
     * @apiName     getDriver
     * @apiGroup    DriverPack
     * @apiParam {string} token token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *      "is_seller_auth": 0,
     *      "is_drv_auth": 1,
     *      "is_home_auth": 0
     *  }
     *  }
     */
    public function index(){
        $drv_data = $this -> seller -> where("seller_id = ".$this -> user_id) -> find();
        if($drv_data["store_id"] !=0 )
            $seller["is_seller_auth"] = 1;
        else
            $seller["is_seller_auth"] = 0;

        if($drv_data["drv_id"] !=0 )
            $seller["is_drv_auth"] = 1;
        else
            $seller["is_drv_auth"] = 0;

        if($drv_data["home_id"] !=0 )
            $seller["is_home_auth"] = 1;
        else
            $seller["is_home_auth"] = 0;
        jsonData(1,"返回成功",$seller);

    }
    /**
     * @api {GET}   /index.php?m=Api&c=Pack&a=auth_img     认证图片
     * @apiName     DriveImg
     * @apiGroup    DriverPack
     * @apiParam {string} token token值
     * @apiSuccess  {string} name 认证名称
     * @apiSuccess  {string} must_info 必填信息
     * @apiSuccess  {string} non_mand 非必填信息
     * @apiSuccess  {string} car_check_img 车检证
     * @apiSuccess  {string} driver_img 驾驶证
     * @apiSuccess  {string} drv_hold_img 手持身份证正面照
     * @apiSuccess  {string} drv_front_img 身份证正面
     * @apiSuccess  {string} drv_back_img 身份证反面
     * @apiSuccess  {string} guide_img 导游证
     * @apiSuccess  {string} boat_img 游艇驾驶证
     * @apiSuccess  {string} auth_status 认证状态
     *
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *      "name": "羊1",
     *      "auth_status": "认证通过",
     *      "img": {
     *      "must_info": [
     *      {
     *          "title": "车检证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "is_must": 1,
     *          "title": "驾驶证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "is_must": 1,
     *          "title": "手持身份证正面照",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "is_must": 1,
     *          "title": "添加身份证正面",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "is_must": 1,
     *          "title": "添加身份证反面",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      }
     *      ],
     *      "non_mand": [
     *      {
     *          "title": "导游证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "title": "游艇驾驶证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      }
     *      ]
     *      }
     *      }
     *      }
     */
    public function auth_img(){
        model("common/PackApply") -> getImgInfo($this->user_id);
    }
}