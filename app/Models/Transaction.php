<?php

namespace App\Models;

use App\Traits\HasDate;
use App\Traits\HasMoney;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use HasDate;
    use HasMoney;
    use SoftDeletes;

    protected $fillable = ['amount', 'note', 'wallet_id', 'category_id', 'created_at'];
    protected $with = ['category'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function negative(): bool
    {
        return $this->category->type === 'expense';
    }

    /**
     * Get the transaction amount
     *
     * @return Attribute
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function toObject(): string
    {

        $date = Carbon::parse($this->created_at);
        $formated = $date->format('Y-m-d');

        return "{
            button: 'Save',
            title: 'Edit transaction #$this->id',
            transaction: {
                id: $this->id,
                amount: $this->amount,
                date: '$formated',
                note: '$this->note',
                category: $this->category,
            },
            deleteTransaction(){
                let result = confirm('Want to delete?');
                if (result) {

                    fetch('" . route('transaction.destroy', ['locale' => app()->getLocale(), 'transaction' => $this->id]) . "', {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            _token: document.head.querySelector('meta[name=csrf-token]').content
                        })
                    }).then(() => {
                        location.reload();
                    })
                }
            },
            submit() {
                fetch('" . route('transaction.update', ['locale' => app()->getLocale(), 'transaction' => $this->id]) . "', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        _token: document.head.querySelector('meta[name=csrf-token]').content,
                        amount: this.transaction.amount,
                        category_type: this.transaction.category.type,
                        category_id: this.transaction.category.id,
                        note: this.transaction.note,
                        date: this.transaction.date,
                    })
                }).then(function (response) {
                    if (response.ok) {
                        return response.text();
                    }

                    throw new Error('Something went wrong.');
                }).then(function (text) {
                    console.log('Request successful', text);
                    location.reload();
                }).catch(function (error) {
                    console.log('Request failed', error);
                    alert(error.message);
                });
            }
        }";
    }
}
