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

class Users extends Model
{
    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化
    }

    public function  updateUser ($seller_id)
    {
        $head_pic = I("head_pic");
        $nickname = I("nickname");
        $sex = I("sex");
        $language = I("language");
        $briefing = I("briefing");
        $img_url = I("img_url");

        $head_pic && $data["head_pic"] = $head_pic;
        $nickname && $data["nickname"] = $nickname;
        $sex && $data["sex"] = $sex;
        $language && $data["language"] = $language;
        $briefing && $data["briefing"] = $briefing;
        $img_url && $data["img_url"] = $img_url;

        if($data)
        {
            M("seller") -> where("seller_id = $seller_id") -> save($data);
            jsonData(1,"修改成功！",[]);
        }
        else
            jsonData(4004,"请至少填写一个信息！",[]);
    }

}
