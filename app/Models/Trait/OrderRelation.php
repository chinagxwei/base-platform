<?php

namespace App\Models\Trait;

use App\Models\System\SystemOrder;

/**
 * @property string order_sn
 * @property SystemOrder order
 */
trait OrderRelation
{
    public function setOrderSn($order_sn)
    {
        $this->order_sn = $order_sn;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(SystemOrder::class, 'sn', 'order_sn');
    }
}
