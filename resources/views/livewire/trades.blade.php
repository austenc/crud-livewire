<div>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-700">Trades</h1>
        <div class="space-y-2 mt-4">
            {{ $this->trades->links() }}
            @forelse ($this->trades as $trade)
                <div class="px-7 py-4 rounded shadow bg-gray-50">
                    <div class="flex justify-between items-center space-x-3">
                        <div class="uppercase">
                            <div class="text-xl font-medium font-mono">
                                {{ $trade->symbol }}
                            </div>
                            <div class="mt-1.5 text-gray-500 text-sm tracking-wide">{{ $trade->side }}</div>
                        </div>
                        <div class="text-xl">
                            <span class="font-mono">{{ $trade->size }}</span> <span class="text-sm uppercase tracking-wide text-gray-400">shares</span>
                        </div>
                        <div class="tabular-nums space-y-2">
                           <div class="flex space-x-4 justify-between items-baseline">
                               <div class="text-gray-400 uppercase text-xs tracking-wide">Entry</div>
                               <div class="font-mono">${{ $trade->entryPriceInDollars }}</div>
                           </div>
                            @if ($trade->exit_at)
                                <div class="flex space-x-4 justify-between items-baseline">
                                    <div class="text-gray-400 uppercase text-xs tracking-wide">Exit</div>
                                    <div class="font-mono">${{ $trade->exitPriceInDollars }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" wire:click="delete({{ $trade->id }})" class="mt-5 text-red-500 text-sm">Delete</button>
                </div>
            @empty
                You don't have any trades yet, create one
            @endforelse
        </div>
    </div>
</div>
