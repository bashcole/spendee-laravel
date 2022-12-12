<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    public $with = ['icon', 'color'];

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function scopeAuthenticatedUser(){
        return $this->where('user_id', Auth::user()->id);
    }
}
