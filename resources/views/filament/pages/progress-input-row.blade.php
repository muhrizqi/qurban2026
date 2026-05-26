<div class="flex items-center justify-between py-1.5 border-b border-gray-50 dark:border-gray-800/40 last:border-0">
    <span class="text-xs font-semibold text-gray-600 dark:text-gray-400">{{ $label }}</span>
    <div class="flex items-center gap-1.5">
        <!-- Decrement Button -->
        <button 
            wire:click="decrement('{{ $field }}')" 
            type="button" 
            class="w-7 h-7 flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-700 text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 active:scale-95 transition font-bold select-none text-sm"
        >
            －
        </button>

        <!-- Input Field -->
        <input 
            type="number" 
            wire:model.live.debounce.500ms="{{ $field }}" 
            class="w-16 h-7 text-center text-xs py-0.5 px-1 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white font-bold focus:border-amber-500 focus:ring-1 focus:ring-amber-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
        />

        <!-- Increment Button -->
        <button 
            wire:click="increment('{{ $field }}')" 
            type="button" 
            class="w-7 h-7 flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-700 text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 active:scale-95 transition font-bold select-none text-sm"
        >
            ＋
        </button>
    </div>
</div>
