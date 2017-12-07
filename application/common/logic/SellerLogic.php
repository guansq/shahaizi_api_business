<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: lhb
 * Date: 2017-05-15
 */

namespace app\common\logic;

/**
 *  逻辑类
 */
class SellerLogic{
    protected $table = 'ruit_seller';

    /**
     * Author: W.W <will.wxx@qq.com>
     * Describe: 根据ID查询seller详情
     * @param $id
     */
    public static function getBaseInfoById($id, $viewerId = 0, $isAnonymous = 0){
        $filed = [
            'seller_id' => 'sellerId',
            'nickname',
            'seller_name' => 'sellerName',
            'hx_user_name' => 'hxName',
            'head_pic' => 'avatar',
            'country_id' => 'countryId',
            'city' => 'cityId',
            'plat_start' => 'platStart',
        ];
        $seller = M('seller')->field($filed)->find($id);
        if(empty($seller)){
            return [];
        }
        $seller['nickname'] = $isAnonymous == 1 ? firstStr($seller['nickname']) : $seller['nickname'];
        $seller['platStart'] = intval($seller['platStart']);
        return $seller;
    }

}