<div class="py-8">
    <div class="max-w-3xl mx-auto">
        <div x-data="{ creating: false }" @trade-saved="creating = false">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-extrabold text-gray-700">Trades</h1>
                <button x-show="!creating" x-on:click="creating = true" type="button" class="px-3 py-1.5 rounded transition duration-300 border border-yellow-600 text-yellow-600 font-medium text-sm hover:bg-yellow-200 hover:text-yellow-900 hover:border-yellow-300 transform hover:-translate-y-px hover:shadow-sm">Add Trade</button>
                <button x-cloak x-show="creating" x-on:click="creating = false" type="button" class="px-3 py-1.5 transition duration-300 text-red-500 font-medium text-sm hover:text-red-800">Cancel</button>
            </div>
            <div x-show.transition="creating" x-cloak>
                <livewire:trade-form />
            </div>
        </div>
        <div class="space-y-2 mt-4">
            @forelse ($trades as $trade)
                <div wire:key="trade-{{ $trade->id }}">
                    <div class="px-4 py-3 rounded shadow-sm bg-gray-50 hover:bg-white transform hover:-translate-y-px transition duration-300">
                        <div class="flex justify-between">
                            <div class="flex-1 uppercase">
                                <div class="text-xl text-gray-600 font-semibold font-mono">
                                    {{ $trade->symbol }}
                                </div>
                                <div class="mt-1.5 text-gray-400 text-sm tracking-wide">{{ $trade->side }}</div>
                            </div>
                            <div class="w-1/4 font-mono text-lg font-semibold">
                                <div class="{{ $trade->profitLossColor }}">
                                    {{ $trade->profitLossWithSign }}
                                </div>
                            </div>
                            {{-- Stats --}}
                            <div class="w-1/4 space-x-3 flex">
                                <div class="flex-1">
                                    <div class="tabular-nums space-y-2 text-xs">
                                        <div class="flex space-x-6 justify-between items-baseline">
                                            <div class="text-gray-400 uppercase text-xs tracking-wide">Shares</div>
                                            <div class="font-mono">{{ $trade->size }}</div>
                                        </div>
                                        <div class="flex space-x-6 justify-between items-baseline">
                                            <div class="text-gray-400 uppercase text-xs tracking-wide">Entry</div>
                                            <div class="font-mono">${{ $trade->entryPriceInDollars }}</div>
                                        </div>
                                        <div class="flex space-x-6 justify-between items-baseline">
                                            <div class="text-gray-400 uppercase text-xs tracking-wide">Exit</div>
                                            @if ($trade->exit_price)
                                                <div class="font-mono">${{ $trade->exitPriceInDollars }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Timestamps --}}
                                <div class="flex-1">
                                    <div class="space-y-2 text-xs">
                                        <div class="font-mono">&nbsp;</div>
                                        <div class="text-gray-400 whitespace-nowrap">{{ $trade->entry_at->diffForHumans() }}</div>
                                        @if ($trade->exit_at)
                                            <div class="text-gray-400 whitespace-nowrap">{{ $trade->exit_at->diffForHumans() }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- Actions --}}
                            <div class="flex-1 flex justify-end items-start space-x-2" x-data>
                                <button type="button" wire:click="edit({{ $trade->id }})" class="transition duration-300 text-gray-300 hover:text-gray-600 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button x-on:click="confirm('Are you sure?') && $wire.delete({{ $trade->id }})" type="button" class="transition duration-300 text-gray-300 hover:text-gray-600 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div> {{-- Trade Card --}}

                    @if ($trade->is($editing))
                        <div wire:key="editing-{{ $loop->index }}" class="px-4 mb-5 bg-gray-100 mx-5 rounded-b shadow-xs">
                            <livewire:trade-form :trade="$editing" :key="'edit-' . $editing->id" />
                        </div>
                    @endif
                </div>
            @empty
                You don't have any trades yet, create one
            @endforelse
            {{ $trades->links() }}
        </div>
    </div>
</div>
