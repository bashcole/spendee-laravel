<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Resources\WalletResource;
use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    /**
     * Create User
     * @param RegisterUserRequest $request
     */
    public function list(Request $request)
    {
        return WalletResource::collection(Wallet::authenticatedUser()->get());
    }

    public function show(Request $request, Wallet $wallet)
    {
        return WalletResource::collection($wallet->authenticatedUser()->get());
    }

}
