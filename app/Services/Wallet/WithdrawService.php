<?php

namespace App\Services\Wallet;

use App\Models\Member\Member;
use App\Models\Wallet\WalletUnit;
use App\Models\Wallet\WalletWithdrawal;
use App\Models\Wallet\WalletWithdrawalAccount;
use App\Models\Wallet\WalletWithdrawalAmountConfig;
use App\Service\DateService;
use App\Service\Order\TradeService;
use App\Service\Statistics\StatisticsFundWaitWithdrawService;
use App\Service\Statistics\StatisticsMemberFundWaitWithdrawService;

class WithdrawService
{
    /** @var Member */
    private $member;

    private $withdraw_amount_config_id = null;

    private $withdraw_account_id;

    private $amount = 0;

    /** @var WalletUnit */
    private $withdraw_balance;

    /** @var WalletWithdrawalAmountConfig */
    private $amountConfig;

    /** @var WalletWithdrawalAccount */
    private $account;

    /**
     * @param Member $member
     * @return $this
     */
    public function setMember($member)
    {
        $this->member = $member;
        return $this;
    }

    /**
     * @param $withdraw_amount_config_id
     * @return WithdrawService
     */
    public function setWithdrawAmountConfigId($withdraw_amount_config_id)
    {
        $this->withdraw_amount_config_id = $withdraw_amount_config_id;
        return $this;
    }

    /**
     * @param $withdraw_account_id
     * @return WithdrawService
     */
    public function setWithdrawAccountId($withdraw_account_id)
    {
        $this->withdraw_account_id = $withdraw_account_id;
        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount * 100;
        return $this;
    }


    /**
     * @return WithdrawService
     * @throws \Exception
     */
    private function checkWithdrawAccount()
    {
        if (empty($this->withdraw_account_id)) {
            throw new \Exception('账户参数错误');
        }
        $this->account = WalletWithdrawalAccount::findOneByID($this->withdraw_account_id);
        if (empty($this->account)) {
            throw new \Exception('账户不存在');
        }
        return $this;
    }

    /**
     * @return WithdrawService
     * @throws \Exception
     */
    private function checkWithdrawConfig()
    {
        if (empty($this->withdraw_amount_config_id)) {
            throw new \Exception('提款项参数错误');
        }
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function checkBalanceAccount()
    {
        $this->withdraw_balance = WalletUnit::findOne($this->member->wallet_id, WalletUnit::DEFAULT_WITHDRAW_BALANCE_UNIT);

        if (empty($this->withdraw_balance)) {
            throw new \Exception('关联账户不存在');
        }
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function checkFixedAmount()
    {
        $this->amountConfig = WalletWithdrawalAmountConfig::findOneByID($this->withdraw_amount_config_id);

        $vipInfo = $this->member->vipInfo;

        if (empty($vipInfo)) {
            if ($this->withdraw_balance->total_balance < $this->amountConfig->amount) {
                throw new \Exception('账户余额不足');
            }
            $this->amount = $this->amountConfig->amount;
        } else {
            if ($this->withdraw_balance->total_balance < $this->amountConfig->vip_amount) {
                if ($this->withdraw_balance->total_balance < $this->amountConfig->amount) {
                    throw new \Exception('账户余额不足');
                } else {
                    $this->amount = $this->amountConfig->amount;
                }
            } else {
                $this->amount = $this->amountConfig->vip_amount;
            }
        }
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function dailyWithdrawFrequency()
    {
        if (empty($this->member->vipInfo)) {
            if (WalletWithdrawal::todayWithdrawExists($this->member->wallet_id, $this->withdraw_amount_config_id)) {
                throw new \Exception('选项今日提现已申请，请选其他项');
            }

            list($start, $end) = DateService::getToday();

            $row = WalletWithdrawal::query()
                ->where('wallet_id', $this->member->wallet_id)
                ->whereBetween('created_at', [$start, $end])
                ->get();

            if ($row && $row->count() >= 3) {
                throw new \Exception('您今日3次申请提现已完成');
            }
        } else {
            if (($vip = $this->member->vipInfo->vip) && !empty($vip->withdraw_maximum_amount_limit)) {

                $total_amount = WalletWithdrawal::todayTotalAmount($this->member->wallet_id);

                if (($total_amount + $this->amount) > $vip->withdraw_maximum_amount_limit) {
                    $msg = "当前VIP等级每日累计提现额度：" . ($vip->withdraw_maximum_amount_limit / 100) . "，当前剩余额度：" . ($vip->withdraw_maximum_amount_limit - $total_amount) / 100;
                    throw new \Exception($msg);
                }
            }
        }

        return $this;
    }

    /**
     * @throws \Exception
     */
    private function checkFixedWithdrawalAmount()
    {
        if (empty($this->member->vipInfo)) {
            if (!$this->amountConfig->isShow()) {
                throw new \Exception('会员提现项目异常');
            }
        } else {
            if ($vip = $this->member->vipInfo->vip) {
                if (!$vip->hasConfig($this->withdraw_amount_config_id)) {
                    throw new \Exception('VIP提现项目异常');
                }
            }
        }

        return $this;
    }

    private function checkCustomWithdrawal()
    {
        $vipInfo = $this->member->vipInfo;
        if (empty($vipInfo)) {
            throw new \Exception('非VIP会员');
        }

        if ($vip = $vipInfo->vip) {
            if (!$vip->custom_withdrawal) {
                throw new \Exception('无法自定义提现');
            }
        }

        return $this;
    }

    private function checkCustomAmount()
    {
        if ($this->withdraw_balance->total_balance < $this->amount) {
            throw new \Exception('账户余额不足');
        }
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function fixedAmountApply()
    {
        return $this->checkWithdrawAccount()
            ->checkWithdrawConfig()
            ->checkBalanceAccount()
            ->checkFixedAmount()
            ->checkFixedWithdrawalAmount()
            ->allowTimeCheck()
            ->dailyWithdrawFrequency()
            ->AccountCheck()
            ->apply();
    }

    /**
     * @throws \Exception
     */
    public function customAmountApply()
    {
        return $this->checkWithdrawAccount()
            ->checkBalanceAccount()
            ->checkCustomWithdrawal()
            ->checkCustomAmount()
            ->allowTimeCheck()
            ->dailyWithdrawFrequency()
            ->AccountCheck()
            ->apply();
    }

//    /**
//     * @return $this
//     * @throws \Exception
//     */
//    private function frequencyCheck()
//    {
//        list($start, $end) = DateService::getToday();
//
//        $row = WalletWithdrawal::query()
//            ->where('wallet_id', $this->member->wallet_id)
//            ->whereBetween('created_at', [$start, $end])
//            ->get();
//
//        if ($row && $row->count() >= 3) {
//            throw new \Exception('您今日3次申请提现已完成');
//        }
//
//        return $this;
//    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function allowTimeCheck()
    {
        $time = date("H");

        if ((8 <= $time) && ($time >= 20)) {
            throw new \Exception('请在每日8:00 - 20:00之间申请提现');
        }
        return $this;
    }

    private function AccountCheck()
    {
        if ($this->account->isBank()) {
            if ($this->amount <= 20000) {
                throw new \Exception('小于200小额提现请使用支付宝');
            }
        }
        return $this;
    }

    private function apply()
    {
        if ($this->amount <= 0) {
            return false;
        }

        $order = TradeService::withdraw($this->member->id, $this->member->wallet_id, $this->amount, WalletUnit::DEFAULT_WITHDRAW_BALANCE_UNIT);

        WalletWithdrawal::generate($this->member->wallet_id, $this->withdraw_account_id, $order->sn, $this->amount, $this->withdraw_amount_config_id);

        StatisticsFundWaitWithdrawService::refresh();

        StatisticsMemberFundWaitWithdrawService::refresh($this->member->id);

        return true;
    }
}
