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
     * @api {GET}   /index.php?m=Api&c=Pack&a=index     司导首页done
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
        {
            $driver_apply = M("pack_driver_apply") -> where("drv_id = ".$drv_data["drv_id"]) -> find();
            if($driver_apply["auth_status"]==1)
                $seller["is_drv_auth"] = 1;
            else
                $seller["is_drv_auth"] = 1;
        }
        else
            $seller["is_drv_auth"] = 0;

        if($drv_data["home_id"] !=0 )
            $seller["is_home_auth"] = 1;
        else
            $seller["is_home_auth"] = 0;
        jsonData(1,"返回成功",$seller);

    }
    /**
     * @api {GET}   /index.php?m=Api&c=Pack&a=auth_img     认证图片done
     * @apiName     DriveImg
     * @apiGroup    DriverPack
     * @apiParam {string} token token值
     * @apiSuccess  {string} name 认证名称
     * @apiSuccess  {string} auth_info 认证失败信息
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *      "name": "羊1",
     *      "auth_status": 1,
     *      "auth_info": "",
     *      "status_text": "认证通过",
     *      "img": {
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
     *          "title": "身份证正面",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "is_must": 1,
     *          "title": "身份证反面",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *    {
     *          "title": "导游证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      },
     *      {
     *          "title": "游艇驾驶证",
     *          "img_url": "http://f10.baidu.com/it/u=4227954,1443099975&fm=76"
     *      }
     *      }
     *      }
     *      }
     */
    public function auth_img(){
        model("common/PackApply") -> getImgInfo($this->user_id);
    }

    /**
     * @api {GET}   /index.php?m=Api&c=Pack&a=actionCar     新增/修改车辆done
     * @apiName     CarInfo
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} [car_id] 修改时传入
     * @apiParam  {string} car_img 车辆图片，多个以|分隔
     * @apiParam  {string} brand_id  车辆品牌id
     * @apiParam  {string} car_type_id  车型id
     * @apiParam  {string} seat_num  座位数
     * @apiParam  {string} car_year  汽车年限
     * @apiParam  {string} is_customer_insurance  是否有保险
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1  200 OK
     * {
     *   "status": 1,
     *   "msg": "返回成功！",
     *   "result": {}
     *  }
     */
    /**
     * 新增车辆或修改
     */
    public function actionCar ()
    {
        model("common/PackApply") -> addCar($this -> user_id);
    }

    /**
     * @api {GET}   /index.php?m=Api&c=Pack&a=getCarBar  获取车辆信息done
     * @apiName     PackGetCarBar
     * @apiGroup    Pack

     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *   "status": 1,
     *   "msg": "返回成功",
     *   "result": [
     *   {
     *      "id": 2,
     *      "car_info": "丰田",
     *      "pid": 0,
     *      "status": 1
     *   }
     *   ]
     *   }
     */

    /**
     * 获取车辆信息
     */
    public function getCarBar ()
    {
        model("common/PackApply") -> getCarInfo();
    }

    /**
     * @api {POST}   /index.php?m=Api&c=Pack&a=auth_img_up     认证图片上传done
     * @apiName     DriverUploadImg
     * @apiGroup    DriverPack
     * @apiParam {string} car_check_img 车见证
     * @apiParam {string} driver_img 驾驶证
     * @apiParam {string} drv_hold_img 手持身份证正面照
     * @apiParam {string} drv_front_img 身份证正面
     * @apiParam {string} drv_back_img 身份证反面
     * @apiParam {string} guide_img 导游证
     * @apiParam {string} boat_img 游艇驾驶证
     * @apiParam {string} token token值
     * @apiSuccess  {string} name 认证名称
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "上传成功",
     *      "result": {}
     * }
     */
    public function auth_img_up(){
        model("common/PackApply") -> upload($this->user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getMyCar   获得我的车辆done
     * @apiName     DriverGetMyCar
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *   "status": 1,
     *   "msg": "返回成功",
     *   "result": [
     *   {
     *      "car_id": 3,
     *      "seller_id": 20,
     *      "brand_id": 1,
     *      "car_type_id": null,
     *      "seat_num": 2,
     *      "car_year": "20",
     *      "is_customer_insurance": 0,
     *      "create_at": null,
     *      "update_at": null,
     *      "is_state": 0,
     *      "plate_number": "苏A-33333",
     *      "seat_size": "小型车",
     *      "car_img": null,
     *      "pass_content": null
     *   },
     *   {
     *      "car_id": 7,
     *      "seller_id": 20,
     *      "brand_id": 1,
     *      "car_type_id": null,
     *      "seat_num": 5,
     *      "car_year": "10",
     *      "is_customer_insurance": 1,
     *      "create_at": null,
     *      "update_at": null,
     *      "is_state": 1,
     *      "plate_number": "苏A-666667",
     *      "seat_size": "中型车",
     *      "car_img": "312154",
     *      "pass_content": ""
     *   }
     *   ]
     *   }
     */
    /**
     * 获取我的车辆
     */
    public function getMyCar ()
    {
        model("common/PackApply") -> getMyAllCar($this -> user_id);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=Pack&a=delMyCar   删除车辆done
     * @apiName     DriverDelMyCar
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} car_id 车辆id，多个删除用逗号隔开
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "删除成功！",
     *      "result": {}
     * }
     */
    /**
     * 删除车辆
     */
    public function delMyCar()
    {
        model("common/PackApply") -> delMyCar($this -> user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=carInfo   获取车辆详情done
     * @apiName     DriverCarInfo
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} car_id 车辆id
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功",
     *      "result": {
     *      "car_id": 3,
     *      "seller_id": 20,
     *      "brand_id": 1,
     *      "car_type_id": 29,
     *      "seat_num": 2,
     *      "car_year": "20",
     *      "is_customer_insurance": 0,
     *      "create_at": "",
     *      "update_at": "",
     *      "is_state": 0,
     *      "plate_number": "苏A-33333",
     *      "seat_size": "小型车",
     *      "car_img": "",
     *      "pass_content": "",
     *      "brand_name": "大众",
     *      "car_type_name": "桑塔纳"
     *    }
     *    }
     */
    public function carInfo ()
    {
        model("common/PackApply") -> getMyCarInfo($this -> user_id);
    }
}