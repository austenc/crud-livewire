<div x-data="{ on: @entangle($attributes->wire('model')->value()) }" @click="on = !on">
    <label class="flex items-center text-gray-500 text-sm cursor-pointer">
        <span :class="{ 'bg-green-200': !on, 'bg-red-400': on }" class="transition-all duration-300 flex items-center rounded-full w-9 h-4 border border-gray-300">
            <span :class="{ '-translate-x-px': !on, 'translate-x-5': on }" class="transition duration-300 transform block w-4 h-4 bg-white shadow rounded-full"></span>
        </span>@if (!$slot->isEmpty())<span class="inline-block ml-1.5">{{ $slot }}</span>@endif
    </label>
</div>