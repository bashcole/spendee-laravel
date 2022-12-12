<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return false;
//        return ($user->wallets()->find($transaction->wallet_id) ?? false)->exists();
    }

    public function create(): bool
    {
        return true;
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return false;
//        return $user->wallets()->find($transaction->wallet_id)->exists();
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->wallets()->find($transaction->wallet_id)->exists();
    }

    public function restore(User $user, Transaction $transaction): bool
    {
        return $user->wallets()->find($transaction->wallet_id)->exists();
    }

    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return $user->wallets()->find($transaction->wallet_id)->exists();
    }
}
