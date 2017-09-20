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
    public function  updateUser ($seller_id)
    {
        $easemobUse = new  \emchat\EasemobUse();
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

        if($nickname)
        {
            $mobile = M("seller") -> where("seller_id = $seller_id") -> value("mobile");
            $hx_user = md5($mobile);
            $easemobUse -> setUserName($hx_user);
            $easemobUse -> updateNickname($nickname);
        }

        if($data)
        {
            M("seller") -> where("seller_id = $seller_id") -> save($data);
            jsonData(1,"修改成功！",[]);
        }
        else
            jsonData(4004,"请至少填写一个信息！",[]);
    }

    public function suggestion_type ()
    {
        $limit = I("limit");
        $limit ? $limit : $limit = 4;
        $suggestion_type =
            M("suggestion_feedback_type")
                -> where("enabled = 1")
                -> limit($limit)
                -> field("id, name")
                -> select();
        dataJson(1,"返回成功！", $suggestion_type);
    }

    public function suggestionFeedback ($seller_id)
    {
        $suggest_id = I("suggest_id");
        $content = I("content");
        $img = I("img_url");
        $img_data =
        [
            "type_id" => $suggest_id,
            "content" => $content,
            "imgurl" => $img,
            "user_id" => $seller_id,
            "type" => 2
        ];

        M("suggestion_feedback") -> add($img_data);

        dataJson(1,"返回成功！", []);
    }

    /**
     * 提现
     */
    public function driveWithdrawals ($seller_id)
    {
        $money= I("money");
        $account = I("account");
        $distill_way = I("distill_way");
        $account_name = I("account_name");
        $distill_id = I("distill_id");

        if(!$money)
            dataJson(4004,"提现金额不能为空！", []);

        if(!$account)
            dataJson(4004,"提现账户不能为空！", []);

        if(!$distill_way)
            dataJson(4004,"提现方式不能为空！", []);

        if(!$account_name)
            dataJson(4004,"账户名不能为空！", []);

        $data["money"] = $money;
        $data["bank_name"] = $distill_way;
        $data["bank_card"] = $account;
        $data["realname"] = $account_name;
        $data["create_time"] = time();
        $data["seller_id"] = $seller_id;
        if($distill_id)
        {
            $with_data = M("driver_withdrawals") -> where("seller_id = $seller_id AND id = $distill_id") -> find();
            if($with_data && $with_data["status"] != 1 && $with_data["status"] != 2)
                M("driver_withdrawals") -> where("seller_id = $seller_id AND id = $distill_id") -> save($data);
            else
                dataJson(4004,"已完成的不能修改！",[]);
        }else
            M("driver_withdrawals")-> add($data);

        dataJson(1,"操作成功！",[]);
    }

    //获取提现列表
    public function getWithdrawalList ($seller_id)
    {
        $paginate = I("pagesize");
        $withData = M("driver_withdrawals")
            -> where("seller_id = $seller_id")
            -> paginate($paginate ? $paginate : 10);

        foreach($withData as $key => $val)
        {
            $val["create_time"] = date("Y-m-d",$val["create_time"]);
            $withData[$key] = $val;
        }
        dataJson(1,"返回成功",$withData);
    }

    /**
     * 【更换手机号】原手机号验证码验证
     */
    public function checkSms ($seller_id)
    {
        $username = I('post.username','');
        $code = I('post.code',0);

        $seller_info =  M("seller") -> where("seller_id = $seller_id") -> find();
        $country_code = $seller_info["country_code"];
        $total_mobile = $country_code.$username;
        if(model("common/Sms") -> checkSms(1,$total_mobile,$code))
        {
            M("sms_info") -> where("mobile = '$total_mobile'") -> save(["is_check" => 1]);
            dataJson(1,"验证成功！",[]);
        }
    }

    /**
     * 【更换手机号】新手机号验证并修改
     */
    public function updateMobile ($seller_id)
    {
        $username = I('post.username','');
        $country_code = I('post.country_code',0);
        $code = I('post.code',0);

        $total_mobile = $country_code.$username;
        if(model("common/Sms") -> checkSms(1,$total_mobile,$code))
        {
            M("sms_info") -> where("mobile = '$total_mobile'") -> save(["is_check" => 1]);
            M("seller") -> where("seller_id = $seller_id") -> save(["country_code" => $country_code,"mobile" => $username]);
            dataJson(1,"更换成功！",[]);
        }
    }

    public function getHxSingleUser ()
    {
        $hx_user = I("hx_user");
        if(!$hx_user)
            dataJson(4004,"环信用户名不能为空！",[]);

        $seller_data = M("seller")  -> field("nickname,head_pic") -> where("hx_user_name = '$hx_user'") -> find();
//        $easemobUse = new  \emchat\EasemobUse();
//        $user_data = $easemobUse -> getUserInfo($hx_user);
        $result["nickname"] = $seller_data["nickname"];
        $result["head_pic"] = $seller_data["head_pic"];
        if(!$seller_data)
            dataJson(0,"返回失败",$seller_data);
        dataJson(1,"返回成功",$seller_data);
    }

    public function getSellerHxName ()
    {
        $seller_id = I("seller_id");
        $seller_data = M("seller")
            -> field("nickname,head_pic,hx_user_name")
            -> where("seller_id = $seller_id")
            -> find();

        $result["nickname"] = $seller_data["nickname"];
        $result["head_pic"] = $seller_data["head_pic"];
        $result["hx_user_name"] = $seller_data["hx_user_name"];

        if(!$seller_data)
            dataJson(0,"返回失败", $seller_data);

        dataJson(1,"返回成功", $seller_data);
    }

    public function getWithdrawal ($seller_id)
    {
        $seller = M("seller") -> where("seller_id = $seller_id ") -> find();
        if(!$seller["drv_id"])
            dataJson(4004,"该司导还没有认证！", []);

        $pack_driver_apply = M("pack_driver_apply") -> where("drv_id = ".$seller["drv_id"]) -> find();
        if($pack_driver_apply["auth_status"] == 0)
            dataJson(4004,"司导认证还未通过不能提现！", []);
        if($pack_driver_apply["auth_status"] == 1)
            dataJson(4004,"司导认证中您还不能提现！", []);
        if($pack_driver_apply["auth_status"] == 3)
            dataJson(4004,"司导认证未通过，您还不能提现！", []);

        dataJson(1,"返回成功",["seller_id" => $seller_id,"drv_money" => sprintf("%.2f",$pack_driver_apply["drv_money"])]);
    }
}
