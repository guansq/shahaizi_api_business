<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导控制器
 */
namespace app\api\controller;
use emchat\EasemobUse;
class Emchat extends Base
{
    /**
     * @api {GET}  /index.php?m=Api&c=Pack&a=getUserSingle  获取单个用户信息done
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
     *}
     */
    public function getUserSingle ()
    {
        return $this -> easeData ->getUserInfo($this->getUserName());
    }
}