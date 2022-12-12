<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasMoney {

    public function moneyFormat($column = 'amount'): string
    {
        return number_format($this->$column, 2);
    }

    public function moneyFormatWithSign($column = 'amount'): string
    {
        return ($this->negative() ? '-' : '+') . $this->moneyFormat($column);
    }

}

