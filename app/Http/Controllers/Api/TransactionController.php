<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Carbon\Carbon;

class TransactionController extends Controller
{

    /**
     * @var TransactionService
     */
    protected $transactionService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * @param CreateTransactionRequest $request
     * @return void
     */
    public function store(CreateTransactionRequest $request)
    {
        $date = Carbon::parse($request->date);
        $this->transactionService->create([
            'amount' => $request->amount,
            'note' => $request->note,
            'wallet_id' => $request->wallet_id,
            'category_id' => $request->category_id,
            'created_at' => $date->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     *
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $date = Carbon::parse($request->date);
        $this->transactionService->update([
            'id' => $transaction->id,
            'amount' => $request->amount,
            'note' => $request->note,
            'category_id' => $request->category_id,
            'created_at' => $date->format('Y-m-d H:i:s')
        ]);
    }

    /**
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->transactionService->destroy($id);
    }
}
