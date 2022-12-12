<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDate {

    public function format($column = 'created_at', $format = 'Y-m-d'): string
    {
        return Carbon::parse($this->$column)->format($format);
    }

    public function ago($column = 'created_at'): string
    {
        return Carbon::parse($this->$column)->diffForHumans();
    }
}

