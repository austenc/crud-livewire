<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Trade;

class TradeForm extends Component
{
    public $creating = false;
    public Trade $trade;

    protected $rules = [
        'trade.symbol' => 'required|alpha',
        'trade.size' => 'required|numeric',
        'trade.is_short' => 'boolean',
        'trade.entry_price_in_dollars' => 'required|numeric',
        'trade.entry_at_for_editing' => 'required|date',
        'trade.exit_price_in_dollars' => 'numeric',
        'trade.exit_at_for_editing' => 'required_with:trade.exit_price_in_dollars|date'
    ];

    public function mount(Trade $trade)
    {
        $this->trade = $trade ?? new Trade;
    }

    public function save()
    {
        $this->validate();
        $creating = empty($this->trade->exists);
        $this->trade->save();
        $this->dispatchBrowserEvent('trade-saved');
        $this->emitUp('refreshTrades');
        if ($creating) {
            $this->trade = new Trade;
        } else {
            $this->emitUp('tradeUpdated', $this->trade);
        }
    }
}
