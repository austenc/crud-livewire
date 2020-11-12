<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Trade;

class Trades extends Component
{
    use WithPagination;

    public function getTradesProperty()
    {
        return Trade::paginate(10);
    }

    public function delete($trade)
    {
        $this->trades->find($trade)->delete();
        $this->trades = Trade::paginate(10);
    }
}
