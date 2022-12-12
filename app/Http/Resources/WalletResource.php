<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Wallet */
class WalletResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'sort' => $this->sort,
            'balance' => $this->balance,
            'other_balance' => $this->other_balance,
            'status' => $this->status,
            'currency_id' => $this->currency_id,
        ];
    }
}
