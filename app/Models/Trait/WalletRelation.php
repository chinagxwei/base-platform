<?php

namespace App\Models\Trait;

use App\Models\System\SystemWallet;

/**
 * @property int wallet_id
 * @property SystemWallet wallet
 */
trait WalletRelation
{
    public function setWallet($wallet_id){
        $this->wallet_id = $wallet_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne(SystemWallet::class, 'id', 'wallet_id');
    }
}
