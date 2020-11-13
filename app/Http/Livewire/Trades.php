<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trade;

class Trades extends Component
{
    use WithPagination;

    public $editing;
    protected $listeners = [
        'tradeUpdated',
        'refreshTrades' => '$refresh',
    ];

    public function delete($trade)
    {
        Trade::findOrFail($trade)->delete();
    }
    public function tradesQuery()
    {
        return Trade::orderBy('created_at', 'desc');
    }

    public function getTradesProperty()
    {
        return $this->tradesQuery()->paginate(10);
    }

    public function edit(Trade $trade)
    {
        if ($trade->is($this->editing)) {
            $this->reset('editing');
            return;
        }
        
        $this->editing = $trade;
    }

    public function tradeUpdated($trade)
    {
        $this->editing = null;
    }

    public function render()
    {
        return view('livewire.trades', [
            'trades' => $this->trades
        ]);
    }
}
