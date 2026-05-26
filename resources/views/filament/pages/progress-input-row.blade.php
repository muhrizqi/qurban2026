<div class="flex items-center justify-between py-2.5 border-b border-gray-100 dark:border-gray-800/40 last:border-0">
    <span class="text-xs font-bold text-gray-700 dark:text-gray-300 pr-2">{{ $label }}</span>
    <div class="flex items-center gap-2">
        <!-- Decrement Button -->
        <button 
            wire:click="decrement('{{ $field }}')" 
            type="button" 
            class="w-10 h-10 flex items-center justify-center rounded-xl border border-red-200 dark:border-red-900/40 text-red-600 dark:text-red-400 bg-red-50/80 dark:bg-red-950/20 hover:bg-red-100 dark:hover:bg-red-950/40 active:scale-90 transition-all font-extrabold select-none text-lg shadow-sm"
        >
            －
        </button>

        <!-- Input Field -->
        <input 
            type="number" 
            wire:model.live.debounce.500ms="{{ $field }}" 
            class="w-20 h-10 text-center text-sm py-1.5 px-2 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-950 dark:text-white font-extrabold focus:border-amber-500 focus:ring-1 focus:ring-amber-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none shadow-sm"
        />

        <!-- Increment Button -->
        <button 
            wire:click="increment('{{ $field }}')" 
            type="button" 
            class="w-10 h-10 flex items-center justify-center rounded-xl border border-green-200 dark:border-green-900/40 text-green-600 dark:text-green-400 bg-green-50/80 dark:bg-green-950/20 hover:bg-green-100 dark:hover:bg-green-950/40 active:scale-90 transition-all font-extrabold select-none text-lg shadow-sm"
        >
            ＋
        </button>
    </div>
</div>
