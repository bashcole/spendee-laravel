<?php

namespace App\Http\Controllers;

use App\Actions\CalculateTotalBalance;
use App\Models\Wallet;
use Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $wallets = Wallet::authenticatedUser()->with(['currency', 'transactions'])->get()->calculateStats();

        $totals = CalculateTotalBalance::do($wallets);

        return view('home', compact('wallets', 'totals'));
    }
}
