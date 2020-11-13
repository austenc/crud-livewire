<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = [
        'entry_at',
        'exit_at'
    ];
    protected $appends = [
        'entry_at_for_editing', 
        'exit_at_for_editing',
        'entry_price_in_dollars',
        'exit_price_in_dollars',
    ];

    protected function toDollars($value)
    {
        return number_format($value / 100, 2);
    }

    public function toCents($value)
    {
        return $value * 100;        
    }

    public function getEntryPriceInDollarsAttribute()
    {
        return $this->entry_price > 0 ? $this->toDollars($this->entry_price) : null;
    }

    public function setEntryPriceInDollarsAttribute($value)
    {
        $this->entry_price = $this->toCents($value);
    }

    public function getExitPriceInDollarsAttribute()
    {
        return $this->exit_price > 0 ? $this->toDollars($this->exit_price) : null;
    }

    public function setExitPriceInDollarsAttribute($value)
    {
        $this->exit_price = $this->toCents($value);
    }

    public function getProfitLossAttribute()
    {
        if (is_null($this->exit_price)) {
            return '';
        }

        if ($this->is_short) {
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

    public function getEntryAtForEditingAttribute()
    {
        return $this->entry_at ? $this->entry_at->format('Y-m-d') : null; 
    }

    public function setEntryAtForEditingAttribute($value)
    {
        $this->entry_at = $value ? Carbon::parse($value) : null;
    }

    public function getExitAtForEditingAttribute()
    {
        return $this->exit_at ? $this->exit_at->format('Y-m-d') : null; 
    }

    public function setExitAtForEditingAttribute($value)
    {
        $this->exit_at = $value ? Carbon::parse($value) : null;
    }

    public function getSideAttribute()
    {
        return $this->is_short ? 'short' : 'long';
    }
}
