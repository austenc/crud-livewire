<div class="py-5">
    <form wire:submit.prevent="save">
        <div class="flex items-center space-x-4">
            <div class="w-2/3 flex space-x-4">
                <div class="flex-grow">
                    <x-input wire:model.defer="trade.symbol" placeholder="Symbol (like TSLA)" />
                </div>
                <div class="flex-grow">
                    <x-input wire:model.defer="trade.size" placeholder="Shares" />
                </div>
            </div>
            <div class="flex flex-grow justify-end items-center space-x-2 text-sm text-gray-400 tracking-wide">
                <div>LONG</div><x-toggle wire:model.defer="trade.is_short" /><div>SHORT</div>
                @error('trade.is_short')
                    <div class="mt-2 text-red-500 text-xs">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mt-4 flex space-x-4">
            <div class="flex-grow">
                <x-input wire:model.defer="trade.entry_price_in_dollars" placeholder="Entry Price" />
            </div>
            <div class="flex-grow">
                <x-input wire:model.defer="trade.entry_at_for_editing" type="date" placeholder="Entry Date" />
            </div>
            <div class="flex-grow">
                <x-input wire:model.defer="trade.exit_price_in_dollars" placeholder="Exit Price" />
            </div>
            <div class="flex-grow">
                <x-input wire:model.defer="trade.exit_at_for_editing" type="date" placeholder="Exit Date" />
            </div>
        </div>
        <div class="mt-4 text-right">
            <button type="submit" class="px-3 py-1.5 transition duration-300 text-sm font-medium bg-blue-400 text-white hover:bg-blue-700 rounded">
                Save Trade
            </button>
        </div>
    </form>
</div>
