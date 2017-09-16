<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导控制器
 */
namespace app\api\controller;
use emchat\Easemob;
class Emchat extends Base {
    public function _initialize ()
    {
        $this -> options['client_id']='YXA6Kv9EIJNtEeewdnMQJ_FKMA';
        $this -> options['client_secret']='YXA65H9MlMZ4OTvc51WwajxViTlHAz0';
        $this -> options['org_name']='1102170901115301';
        $this -> options['app_name']='shahaizi';
        $this -> easeData = new Easemob($this -> options);
    }

    public function getUserInfo ()
    {
        $i=15;
        switch($i){
            case 15 :
                $data = $this -> easeData ->getUsers();
                print_r($data);die;
                break;
        }
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
}