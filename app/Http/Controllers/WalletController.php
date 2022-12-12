<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function show(Request $request, Wallet $wallet)
    {

        $allCategories = Category::authenticatedUser()->get();
        $categories = [
            'income' => $allCategories->where('type', 'income'),
            'expense' => $allCategories->where('type', 'expense'),
        ];

        $start = $request->query('start') ?? Carbon::now()->startOfMonth();
        $end = $request->query('end') ?? Carbon::now()->endOfMonth();

        $transactions = $wallet->transactions()
//            ->where('created_at', '>=', $start)
//            ->where('created_at', '<=', $end)
            ->with(['category.color', 'category.icon'])
            ->orderBy('created_at', 'desc')->get()->groupBy(function ($transaction) {
                return Carbon::parse($transaction->created_at)->format('M Y');
            });

        return view('wallet', compact(
            'start',
            'end',
            'wallet',
            'categories',
            'transactions'));
    }
}
