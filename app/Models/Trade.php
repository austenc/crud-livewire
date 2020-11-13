<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected const SHORT = 'short';

    protected $guarded = [];
    protected $dates = [
        'entry_at',
        'exit_at'
    ];

    protected function toDollars($value)
    {
        return number_format($value / 100, 2);
    }

    public function getEntryPriceInDollarsAttribute()
    {
        return $this->toDollars($this->entry_price);
    }

    public function getExitPriceInDollarsAttribute()
    {
        return $this->toDollars($this->exit_price);
    }

    public function getProfitLossAttribute()
    {
        if (is_null($this->exit_price)) {
            return '';
        }

        if ($this->side == self::SHORT) {
            return $this->toDollars(($this->entry_price - $this->exit_price) * $this->size);
        }
        
        return $this->toDollars(($this->exit_price - $this->entry_price) * $this->size);
    }

    public function getProfitLossWithSignAttribute()
    {
        return $this->profitLoss > 0 
            ? '+' . $this->profitLoss 
            : $this->profitLoss;
    }
    
    public function getProfitLossColorAttribute()
    {
        return $this->profitLoss > 0 ? 'text-green-400' : 'text-red-400';
    }
}
