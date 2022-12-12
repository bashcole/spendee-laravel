<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class CalculateTotalBalance
{

    /**
     * @param Collection $wallets
     * @return array
     */
    public static function do(Collection $wallets): array
    {
        return [
            'balance' => $wallets->reduce(function ($acc, $wallet) {
                return $acc + $wallet['balance'];
            }, 0),
            'totalIncome' => $wallets->reduce(function ($acc, $wallet) {
                return $acc + $wallet->stats->totalPeriodIncome;
            }, 0),
            'totalExpenses' => $wallets->reduce(function ($acc, $wallet) {
                return $acc + $wallet->stats->totalPeriodExpenses;
            }, 0),
        ];
    }
}
