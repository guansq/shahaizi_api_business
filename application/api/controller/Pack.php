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
     *          "is_seller_auth": 0,
     *          "is_drv_auth": 1,
     *          "is_home_auth": 0
     *      }
     *  }
     */
    public function index(){
        $drv_data = $this -> seller -> where("seller_id = ".$this -> user_id) -> find();
        if($drv_data["store_id"] !=0 )
            $seller["is_seller_auth"] = 1;
        else
            $seller["is_seller_auth"] = 0;
        $drv_data["drv_id"] && $driver_apply = M("pack_driver_apply") -> where("drv_id = ".$drv_data["drv_id"]) -> find();
            if($driver_apply)
            {
                if($driver_apply["auth_status"]==1)
                    $seller["is_drv_auth"] = 1;
                elseif($driver_apply["auth_status"]==2)
                    $seller["is_drv_auth"] = 2;
                elseif($driver_apply["auth_status"]==3)
                    $seller["is_drv_auth"] = 3;
            }else
            {
                $seller["is_drv_auth"] = 0;
            }


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

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=confirmOrder  确认订单done
     * @apiName     DriverConfirmOrder
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} air_id air_id值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "订单确认成功！",
     *      "result": {}
     * }
     */
    public function confirmOrder()
    {
        model("common/PackApply") -> confirmOrder($this -> user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=helpCenter&pagesize=   司导-帮助中心done
     * @apiName     DriverHelpCenter
     * @apiGroup    Pack
     * @apiParam {string} pagesize 显示条数
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *  "status": 1,
     *  "msg": "返回成功！",
     *  "result": {
     *  "total": 2,
     *  "per_page": 10,
     *  "current_page": 1,
     *  "data": [
     *  {
     *      "article_id": 15,
     *      "cat_id": 22,
     *      "title": "当地人服务安全吗",
     *      "content": "&lt;p&gt;安全的&lt;/p&gt;",
     *      "author": "",
     *      "author_email": "",
     *      "keywords": "",
     *      "article_type": 2,
     *      "is_open": 0,
     *      "add_time": 1505266952,
     *      "file_url": "",
     *      "open_type": 0,
     *      "link": "",
     *      "description": "",
     *      "click": 1188,
     *      "publish_time": 1505318400,
     *      "thumb": ""
     *  },
     *  {
     *      "article_id": 16,
     *      "cat_id": 22,
     *      "title": "如何购买当地人服务？",
     *      "content": "&lt;p&gt;请联系客服人员咨询&lt;/p&gt;",
     *      "author": "",
     *      "author_email": "",
     *      "keywords": "",
     *      "article_type": 2,
     *      "is_open": 0,
     *      "add_time": 1505267021,
     *      "file_url": "",
     *      "open_type": 0,
     *      "link": "",
     *      "description": "",
     *      "click": 1118,
     *      "publish_time": 1505318400,
     *      "thumb": ""
     *   }
     *      ]
     *  }
     *  }
     */
    /**
     * 帮助中心
     */
    public function helpCenter ()
    {
        model("common/PackApply") -> help_center();
    }

    /**
     * @api {POST}  /index.php?m=Api&c=Pack&a=overtime   申请加班done
     * @apiName     DriverOvertime
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} air_id air_id值
     * @apiParam {string} add_reason 加班理由
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "申请成功！",
     *      "result": {}
     * }
     */
    /**
     * 申请加班
     */
    public function overtime ()
    {
          model("common/PackApply") -> overtime_recharge($this -> user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getOvertime   获取加班时间done
     * @apiName     GetOvertime
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} air_id air_id值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "申请成功！",
     *      "result": {}
     * }
     */
    /**
     * 获取加班时间
     */
    public function getOvertime ()
    {
        model("common/PackApply") -> getOverTime($this -> user_id,1);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=Pack&a=publishLine   发布线路done
     * @apiName     PublishLine
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} line_title 线路标题
     * @apiParam {string} line_price 线路价格
     * @apiParam {string} car_id  车辆id,多个以逗号隔开
     * @apiParam {string} cover_img  封面图片
     * @apiParam {string} bright_dot  亮点
     * @apiParam {string} line_detail  线路详情 示例： [{"date_num":1,"summary":"\u8fd9\u662f\u6458\u89811","port_detail":[{"port_num":1,"port_coverImg":"http:\/\/ovwiqces1.bkt.clouddn.com\/cee31c276bb2c1ee71391ac799ed78cc.png","port_detail":"\u8fd9\u662f\u7b2c\u4e00\u7ad91"},{"port_num":2,"port_coverImg":"http:\/\/ovwiqces1.bkt.clouddn.com\/cee31c276bb2c1ee71391ac799ed78cc.png","port_detail":"\u8fd9\u662f\u7b2c\u4e8c\u7ad92"}]},{"date_num":2,"summary":"\u8fd9\u662f\u6458\u89811","port_detail":[{"port_num":1,"port_coverImg":"http:\/\/ovwiqces1.bkt.clouddn.com\/cee31c276bb2c1ee71391ac799ed78cc.png","port_detail":"\u8fd9\u662f\u7b2c\u4e00\u7ad91"},{"port_num":2,"port_coverImg":"http:\/\/ovwiqces1.bkt.clouddn.com\/cee31c276bb2c1ee71391ac799ed78cc.png","port_detail":"\u8fd9\u662f\u7b2c\u4e8c\u7ad92"}]}]
     * @apiParam {string} line_id  线路id 为空时为添加，存在时为修改
     * @apiSuccessExample {json}  Success-Response
     *  Http/1.1    200 OK
     * {
     *    "status": 1,
     *    "msg": "发布成功！",
     *    "result": []
     *  }
     */
    /**
     * 发布线路
     */
    public function publishLine ()
    {
        model("common/PackApply") -> publish_line($this -> user_id);
    }


    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=lineDetail&token=37cd1e8ea0c8b81f1fcc03d178625599&line_id=8   线路详情done
     * @apiName     LineDetail
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} line_id line_id值
     */
    /**
     * 线路详情
     */
    public function lineDetail ()
    {
        $line_data = model("common/PackApply") -> getLineDetail($this -> user_id,1);
//print_r($line_data);die;
        $this -> assign("line_data",$line_data);
        return $this -> fetch();
    }

    public function userAgreement ()
    {
        return $this -> fetch("user_agreement");
    }
    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=collegeList  司导学院文章列表done
     * @apiName     College
     * @apiGroup    Pack
     * @apiParam {string} pagesize  展示数目
     * @apiParam {string} page  页数
     * @apiSuccessExample {json}  Success-Response
     *  Http/1.1    200 OK
     * {
     *
     * }
     */
    public function collegeList ()
    {
        $pagesize = I("pagesize");
        $article_lists = M("article") -> field("article_id,title,description") -> where("cat_id = 29") -> paginate($pagesize ? $pagesize : 10);
        dataJson(1,"返回成功！",$article_lists);
    }

    /**
     * 通知公告
     */
    public function noticeList ()
    {
        $pagesize = I("pagesize");
        $article_lists = M("article") -> field("article_id,title,description") -> where("cat_id = 36") -> paginate($pagesize ? $pagesize : 10);
        dataJson(1,"返回成功！",$article_lists);
    }
    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=college&id=19  司导学院文章详情done
     * @apiName     College
     * @apiGroup    Pack
     * @apiParam {string} id  文章列表的article_id值
     */
    /**
     * 司导学院文章详情
     */
    public function college ()
    {
        $id = I("id");
        if(!$id)
            dataJson(4004,"文章id不能为空！",[]);

        $article = M("article") -> where("cat_id = 29 AND article_id = $id") -> find();
//        print_r($article);die;
        $article["content"] = htmlspecialchars_decode($article["content"]);
        $this->assign("article",$article);
        return $this-> fetch();
    }

    public function notice ()
    {
        $id = I("id");
        if(!$id)
            dataJson(4004,"文章id不能为空！",[]);

        $article = M("article") -> where("cat_id = 36 AND article_id = $id") -> find();
//        print_r($article);die;
        $article["content"] = htmlspecialchars_decode($article["content"]);
        $this->assign("article",$article);
        return $this-> fetch("college");
    }

    /**
     * @api {POST}  /index.php?m=Api&c=Pack&a=delLine   删除线路done
     * @apiName     DelLine
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} line_id line_id值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "删除成功！",
     *      "result": {}
     * }
     */
    /**
     * 删除线路
     */
    public function delLine ()
    {
        model("common/PackApply") -> delLine($this -> user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getLinelist   线路列表/我的服务done
     * @apiName     GetLinelist
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} pagesize 显示条数
     * @apiSuccess  {String} is_state 0:待审核1:审核通过2:已拒绝
     * @apiSuccess  {String} result 返回成功
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     *  {
     *    "status": 1,
     *    "msg": "返回成功！",
     *    "result": {
     *        "total": 4,
     *        "per_page": 10,
     *        "current_page": 1,
     *        "data": [
     *            {
     *                "line_id": 5,
     *                "line_title": "墨西哥",
     *                "line_price": "500.00RMB",
     *                "seller_id": 20,
     *                "car_id": "3",
     *                "line_highlights": "亮点多多",
     *                "line_detail": [
     *                    {
     *                        "date_num": 1,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    },
     *                    {
     *                        "date_num": 2,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    }
     *                ],
     *                "create_at": null,
     *                "update_at": null,
     *                "is_comm": 0,
     *                "cover_img": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                "is_state": 0,
     *                "pass_content": null,
     *                "is_del": 0
     *            },
     *            {
     *                "line_id": 4,
     *                "line_title": "菲律宾",
     *                "line_price": "500.00RMB",
     *                "seller_id": 20,
     *                "car_id": "3",
     *                "line_highlights": "亮点多多",
     *                "line_detail": [
     *                    {
     *                        "date_num": 1,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    },
     *                    {
     *                        "date_num": 2,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    }
     *                ],
     *                "create_at": null,
     *                "update_at": null,
     *                "is_comm": 0,
     *                "cover_img": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                "is_state": 0,
     *                "pass_content": null,
     *                "is_del": 0
     *            },
     *            {
     *                "line_id": 3,
     *                "line_title": "新加坡",
     *                "line_price": "500.00RMB",
     *                "seller_id": 20,
     *                "car_id": "3",
     *                "line_highlights": "亮点多多",
     *                "line_detail": [
     *                    {
     *                        "date_num": 1,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    },
     *                    {
     *                        "date_num": 2,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    }
     *                ],
     *                "create_at": null,
     *                "update_at": null,
     *                "is_comm": 0,
     *                "cover_img": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                "is_state": 0,
     *                "pass_content": null,
     *                "is_del": 0
     *            },
     *            {
     *                "line_id": 2,
     *                "line_title": "菲律宾",
     *                "line_price": "500.00RMB",
     *                "seller_id": 20,
     *                "car_id": "3",
     *                "line_highlights": "亮点多多",
     *                "line_detail": [
     *                    {
     *                        "date_num": 1,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    },
     *                    {
     *                        "date_num": 2,
     *                        "summary": "这是摘要1",
     *                        "port_detail": [
     *                            {
     *                                "port_num": 1,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第一站1"
     *                            },
     *                            {
     *                                "port_num": 2,
     *                                "port_coverImg": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                                "port_detail": "这是第二站2"
     *                            }
     *                        ]
     *                    }
     *                ],
     *                "create_at": null,
     *                "update_at": null,
     *                "is_comm": 0,
     *                "cover_img": "http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png",
     *                "is_state": 0,
     *                "pass_content": null,
     *                "is_del": 0
     *            }
     *        ]
     *    }
     *}
     */
    public function getLinelist ()
    {
        model("common/PackApply") -> getLinelist($this -> user_id);
    }

    /**
     * @api {POST}  /index.php?m=Api&c=Pack&a=postComment   提交评价done
     * @apiName     PostComment
     * @apiGroup    Pack
     * @apiParam {string} token token值
     * @apiParam {string} score 评分值
     * @apiParam {string} content 评价内容
     * @apiParam {string} order_id 订单id
     * @apiParam {string} image 订单评论图片
     * @apiParam {string} is_anonymous 是否匿名
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *      "status": 1,
     *      "msg": "返回成功！",
     *      "result": []
     * }
     */
    /*
     * 提交评价
     */
    public function  postComment ()
    {
        model("common/PackApply") -> postComment($this -> user_id);
    }

    public function fixOrderTime ()
    {
        model("common/PackApply") -> fixOrderTime($this -> user_id);
    }


    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getArea  获取国家省市区done
     * @apiName   GetArea
     * @apiGroup  Pack
     * @apiParam {string} continent 大洲id 0为获取所有大洲
     * @apiParam {string} country 国家id 0为获取所有国家
     * @apiParam {string} province 省id 0为获取所有省
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *   "status": 1,
     *   "msg": "返回成功！",
     *   "result":
     * [
     *       {
     *           "id": 2,
     *           "name": "北京市",
     *           "level": 2,
     *           "parent_id": 1,
     *           "is_hot": 0,
     *           "country_id": 7
     *       },
     *       {
     *           "id": 300,
     *           "name": "县",
     *           "level": 2,
     *           "parent_id": 1,
     *           "is_hot": 0,
     *           "country_id": 7
     *       },
     *       {
     *           "id": 47498,
     *           "name": "海淀区",
     *           "level": 2,
     *           "parent_id": 1,
     *           "is_hot": 1,
     *           "country_id": 7
     *       }
     *   ]
     *   }
     */
    /**
     * 获取地区
     */
    public function getArea ()
    {
        model("common/PackApply") -> getArea();
    }


    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=recharge_desc  费用说明
     * @apiName   RechargeDesc
     * @apiGroup  Pack
     * @apiParam {string} id  24是id不为空 25是改退补偿
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     * {
     *    "status": 1,
     *    "msg": "返回成功",
     *    "result": {
     *        "title": "费用补偿",
     *        "content": "<p>这里是费用补偿</p>"
     *    }
     * }
     */
    /**
     * 费用补偿说明
     */
    public function  recharge_desc ()
    {
        $article_id = I("id");
        if(!$article_id)
            jsonData(0,"id不能为空！",[]);

        $article = M("article") -> field("title,content") -> where("article_id = $article_id") -> find();
        $article["content"] = htmlspecialchars_decode($article["content"]);
        jsonData(1,"返回成功",$article);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getOrderComment  获取订单评论
     * @apiName   GetOrderComment
     * @apiGroup  Pack
     * @apiParam {string} token  token值
     * @apiParam {string} air_id  对应的air_id
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     *  {
     *       "status": 1,
     *       "msg": "返回成功！",
     *       "result": [
     *           {
     *               "order_commemt_id": 18,
     *               "order_id": 20,
     *               "store_id": 0,
     *               "user_id": 20,
     *               "describe_score": "0.0",
     *               "seller_score": "1.0",
     *               "logistics_score": "0.0",
     *               "commemt_time": 1505550124,
     *               "deleted": 0,
     *               "type": 2,
     *               "is_anonymous": 1,
     *               "content": "heheh",
     *               "img": ""
     *           }
     *       ]
     *   }
     */
    public function getOrderComment ()
    {
        model("common/PackApply") -> getOrderCommentBaseOrderId($this -> user_id);
    }

    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getOrderAllComment  获取司导所有订单评论
     * @apiName   GetOrderAllComment
     * @apiGroup  Pack
     * @apiParam {string} token  token值
     * @apiSuccessExample {json}    Success-Response
     *  Http/1.1    200 OK
     *  {
     *       "status": 1,
     *       "msg": "返回成功！",
     *       "result": [
     *           {
     *               "order_commemt_id": 18,
     *               "order_id": 20,
     *               "store_id": 0,
     *               "user_id": 20,
     *               "describe_score": "0.0",
     *               "seller_score": "1.0",
     *               "logistics_score": "0.0",
     *               "commemt_time": 1505550124,
     *               "deleted": 0,
     *               "type": 2,
     *               "is_anonymous": 1,
     *               "content": "heheh",
     *               "img": ""
     *           }
     *       ]
     *   }
     */
    public function getOrderAllComment ()
    {
        model("common/PackApply") -> getOrderAllComment($this -> user_id);
    }
}