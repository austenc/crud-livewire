<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = [
        'entry_at',
        'exit_at'
    ];

    public function getEntryPriceInDollarsAttribute()
    {
        return number_format($this->entry_price / 100, 2);
    }

    public function getExitPriceInDollarsAttribute()
    {
        return number_format($this->exit_price / 100, 2);
    }
}
