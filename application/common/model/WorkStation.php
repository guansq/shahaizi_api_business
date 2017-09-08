<?php
/**
 * User: Plator
 * Date: 2017/9/8
 * Time: 9:43
 * Desc: 司导工作台模型
 */
namespace app\common\model;

use think\Db;
use think\Model;
use app\common\logic\FlashSaleLogic;
use app\common\logic\GroupBuyLogic;

class WorkStation extends Model
{
    protected $table = "pack_order";
    public function getMyWorkStation ($seller_id)
    {
        $this->where("seller_id = $seller_id") -> paginate();
    }
}
