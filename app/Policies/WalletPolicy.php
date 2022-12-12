<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }

    public function delete(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }

    public function restore(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }

    public function forceDelete(User $user, Wallet $wallet): bool
    {
        return $user->id === $wallet->user_id;
    }
}
