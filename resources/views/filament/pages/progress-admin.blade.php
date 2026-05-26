<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Floating Preview Section -->
        <div class="flex flex-wrap items-center justify-between gap-4 p-4 border rounded-xl bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm">
            <div>
                <h4 class="text-base font-bold text-gray-900 dark:text-white">Panel Preview Publik</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Buka link berikut untuk melihat tampilan dashboard yang akan ditampilkan di TV.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/progressreport" target="_blank" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-amber-600 rounded-lg hover:bg-amber-500 shadow transition">
                    🖥️ Buka Live Dashboard
                </a>
                <a href="/progressreport/playback" target="_blank" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-800 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                    🎞️ Playback Animasi
                </a>
            </div>
        </div>

        <!-- 6 Blocks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <!-- BLOCK 1: PENYEMBELIHAN -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">1. Penyembelihan</h3>
                    <select wire:model.live="color_block_1" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Sapi -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sapi</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_sapi_tersembelih'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_sapi_total'])
                    </div>
                    <hr class="border-gray-100 dark:border-gray-800">
                    <!-- Kambing -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kambing</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_kambing_tersembelih'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_kambing_total'])
                    </div>
                </div>
            </div>

            <!-- BLOCK 2: PENGELETAN -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">2. Pengeletan</h3>
                    <select wire:model.live="color_block_2" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Sapi -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sapi</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_sapi_terkelet'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_sapi_total'])
                    </div>
                    <hr class="border-gray-100 dark:border-gray-800">
                    <!-- Kambing -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kambing</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_kambing_terkelet'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_kambing_total'])
                    </div>
                </div>
            </div>

            <!-- BLOCK 3: PENIMBANGAN -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">3. Penimbangan</h3>
                    <select wire:model.live="color_block_3" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Sapi Reguler -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sapi Reguler</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_reguler_tertimbang'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_reguler_total'])
                    </div>
                    <hr class="border-gray-100 dark:border-gray-800">
                    <!-- Sapi Khusus -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Sapi Khusus (Super, Duper, PB)</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_khusus_tertimbang'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_khusus_total'])
                    </div>
                    <hr class="border-gray-100 dark:border-gray-800">
                    <!-- Kambing -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kambing</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_kambing_tertimbang'])
                        @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_kambing_total'])
                    </div>
                </div>
            </div>

            <!-- BLOCK 4: SOHIBUL QURBAN SAPI -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden md:col-span-2 xl:col-span-1">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">4. Sohibul Qurban Sapi</h3>
                    <select wire:model.live="color_block_4" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Sync Button -->
                    <button wire:click="updateBlock4FromDatabase" type="button" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 transition shadow-sm">
                        🔄 Sinkronisasi Statistik dari Database Sohibul
                    </button>

                    <!-- Sapi Reguler -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Sapi Reguler</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_reguler_terbungkus'])
                        
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Total Sohibul (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_reguler_total }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Tidak Diambil (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_reguler_tidak_diambil }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Terdistribusi (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_reguler_terdistribusi }}</span>
                        </div>
                    </div>
                    <hr class="border-gray-100 dark:border-gray-800">
                    <!-- Sapi Khusus -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Sapi Khusus (Super, Duper, PB)</div>
                        @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_khusus_terbungkus'])
                        
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Total Sohibul (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_khusus_total }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Tidak Diambil (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_khusus_tidak_diambil }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-1">
                            <span class="text-gray-500">Terdistribusi (Auto)</span>
                            <span class="font-bold dark:text-white">{{ $sohibul_sapi_khusus_terdistribusi }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BLOCK 5: SOHIBUL QURBAN KAMBING -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">5. Sohibul Kambing</h3>
                    <select wire:model.live="color_block_5" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    @include('filament.pages.progress-input-row', ['label' => 'Terbungkus', 'field' => 'sohibul_kambing_terbungkus'])
                    @include('filament.pages.progress-input-row', ['label' => 'Terdistribusi', 'field' => 'sohibul_kambing_terdistribusi'])
                    @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'sohibul_kambing_total'])
                </div>
            </div>

            <!-- BLOCK 6: DISTRIBUSI BUNGKUSAN DAGING -->
            <div class="border rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-sm text-gray-800 dark:text-gray-200 uppercase tracking-wider">6. Distribusi Bungkus Daging</h3>
                    <select wire:model.live="color_block_6" class="text-xs py-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500">
                        <option value="emerald">💚 Emerald</option>
                        <option value="indigo">💙 Indigo</option>
                        <option value="violet">💜 Violet</option>
                        <option value="rose">❤️ Rose</option>
                        <option value="amber">💛 Amber</option>
                        <option value="sky">🩵 Sky</option>
                    </select>
                </div>
                <div class="p-5 space-y-4">
                    @include('filament.pages.progress-input-row', ['label' => 'Terbungkus', 'field' => 'bungkusan_daging_terbungkus'])
                    @include('filament.pages.progress-input-row', ['label' => 'Terdistribusi', 'field' => 'bungkusan_daging_terdistribusi'])
                    @include('filament.pages.progress-input-row', ['label' => 'Total Bungkusan', 'field' => 'bungkusan_daging_total'])
                </div>
            </div>

        </div>
    </div>
</x-filament-panels::page>
