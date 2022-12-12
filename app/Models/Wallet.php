<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Wallet extends Model
{
    use HasFactory;

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function bgnRate()
    {
        $rates = [
            'BGN' => 1,
            'USD' => 1.63218,
            'EUR' => 1.95891
        ];
        return $rates[$this->currency->alphabeticCode];
    }

    public function convertToBgn($value, $format = true){
        return $format ? number_format($value * $this->bgnRate(), 2) : $value * $this->bgnRate();
    }

    public function sumTransactions($transactions){
        return $transactions->reduce(function ($carry, $transaction) {
            return $carry + ($transaction['amount'] * ($transaction->category->type === 'income' ? 1 : -1));
        }, 0);
    }

    public function stats(){

        $stats = new stdClass();

        $stats->totalPeriodExpenses  = $this->creditBalanceOn(now());
        $stats->totalPeriodIncome    = $this->debitBalanceOn(now());
        $stats->currentWalletBalance = $stats->totalPeriodIncome - $stats->totalPeriodExpenses;

        $stats->totalPeriodChange = $stats->totalPeriodIncome - $stats->totalPeriodExpenses;

        return $stats;
    }

    /**
     * Get the balance of the journal as of right now, excluding future transactions.
     */
    public function currentBalance()
    {
        return $this->balanceOn(Carbon::now());
    }

    /**
     * Get the balance of the journal based on a given date.
     */
    private function balanceOn(Carbon $date)
    {
        return $this->debitBalanceOn($date) - $this->creditBalanceOn($date);
    }

    /**
     * Get the debit only balance of the journal based on a given date.
     */
    public function debitBalanceOn(Carbon $date)
    {
        return $this->balanceByTypeOn('income', $date);
    }

    /**
     * Get the credit only balance of the journal based on a given date.
     */
    public function creditBalanceOn(Carbon $date)
    {
        return $this->balanceByTypeOn('expense', $date);
    }

    private function balanceByTypeOn($type, $date)
    {
        return $this->transactions
            ->where('created_at', '<=', $date)
            ->where('category.type', $type)
            ->sum('amount');
    }

    /**
     * Calculate the dollar amount debited to a journal today
     * @return float|int
     */
    public function debitAmountToday()
    {
        $today = Carbon::now();
        return $this->amountByTypeOn(
            'income',
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay()
        );
    }

    /**
     * Calculate the dollar amount credited to a journal today
     * @return float|int
     */
    public function creditAmountToday()
    {
        $today = Carbon::now();
        return $this->amountByTypeOn(
            'credit',
            $today->copy()->startOfDay(),
            $today->copy()->endOfDay()
        );
    }

    /**
     * Calculate the dollar amount debited to a journal on a given day
     * @param Carbon $date
     * @return float|int
     */
    public function amountByTypeOn(string $type, Carbon $fromDate, Carbon $toDate)
    {
        return $this->transactions()->where('category.type', $type)
            ->whereBetween('created_at', [
                $fromDate,
                $toDate
            ])->sum('amount');
    }

    /**
     * Calculate the dollar amount credited to a journal on a given day
     * @param Carbon $date
     * @return float|int
     */

    /**
     * Get the balance of the journal.  This "could" include future dates.
     */
    public function totalBalance()
    {
        return $this->transactions()->where('category.type', 'income')->sum('amount') - $this->transactions()->where('category.type', 'expense')->sum('amount');
    }

    public function scopeAuthenticatedUser(){
        return $this->where('user_id', Auth::user()->id);
    }
}
