<x-filament-panels::page>
    @php
        // Map theme colors to tailwind border, background wash, and text classes
        $colorMap = [
            'emerald' => [
                'border' => 'border-t-emerald-500 dark:border-t-emerald-600',
                'bg'     => 'bg-emerald-50/50 dark:bg-emerald-950/15',
                'text'   => 'text-emerald-700 dark:text-emerald-400',
                'dot'    => 'bg-emerald-500'
            ],
            'indigo' => [
                'border' => 'border-t-indigo-500 dark:border-t-indigo-600',
                'bg'     => 'bg-indigo-50/50 dark:bg-indigo-950/15',
                'text'   => 'text-indigo-700 dark:text-indigo-400',
                'dot'    => 'bg-indigo-500'
            ],
            'violet' => [
                'border' => 'border-t-violet-500 dark:border-t-violet-600',
                'bg'     => 'bg-violet-50/50 dark:bg-violet-950/15',
                'text'   => 'text-violet-700 dark:text-violet-400',
                'dot'    => 'bg-violet-500'
            ],
            'rose' => [
                'border' => 'border-t-rose-500 dark:border-t-rose-600',
                'bg'     => 'bg-rose-50/50 dark:bg-rose-950/15',
                'text'   => 'text-rose-700 dark:text-rose-400',
                'dot'    => 'bg-rose-500'
            ],
            'amber' => [
                'border' => 'border-t-amber-500 dark:border-t-amber-600',
                'bg'     => 'bg-amber-50/50 dark:bg-amber-950/15',
                'text'   => 'text-amber-700 dark:text-amber-400',
                'dot'    => 'bg-amber-500'
            ],
            'sky' => [
                'border' => 'border-t-sky-500 dark:border-t-sky-600',
                'bg'     => 'bg-sky-50/50 dark:bg-sky-950/15',
                'text'   => 'text-sky-700 dark:text-sky-400',
                'dot'    => 'bg-sky-500'
            ],
        ];
    @endphp

    <div class="space-y-8">
        <!-- Floating Preview & Global Settings Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-5 border rounded-xl bg-gray-50 dark:bg-gray-900/60 border-gray-200 dark:border-gray-800 shadow-sm">
            <div class="space-y-1">
                <h4 class="text-base font-bold text-gray-900 dark:text-white">Panel Preview & Pengaturan Tema</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400">Atur nuansa warna TV layer dan akses link visualisasi publik.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-4">
                <!-- Theme Mode Select -->
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Tampilan TV:</span>
                    <select wire:model.live="theme" class="text-xs py-1.5 px-3 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 font-semibold focus:ring-amber-500 focus:border-amber-500">
                        <option value="dark">🌑 Gelap (Dark Mode)</option>
                        <option value="light">☀️ Cerah (Light Mode)</option>
                    </select>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="/progressreport" target="_blank" class="inline-flex items-center justify-center px-4 py-1.5 text-xs font-bold text-white bg-amber-600 rounded-lg hover:bg-amber-500 shadow-sm transition active:scale-95">
                        🖥️ Live TV Dashboard
                    </a>
                    <a href="/progressreport/playback" target="_blank" class="inline-flex items-center justify-center px-4 py-1.5 text-xs font-bold text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-800 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition active:scale-95">
                        🎞️ Playback Animasi
                    </a>
                    <button 
                        wire:click="clearLogs" 
                        wire:confirm="Apakah Anda yakin ingin menghapus semua data log? Semua data animasi playback dari awal akan hilang."
                        type="button" 
                        class="inline-flex items-center justify-center px-4 py-1.5 text-xs font-bold text-white bg-red-600 hover:bg-red-500 dark:bg-red-750 dark:hover:bg-red-600 rounded-lg shadow-sm transition active:scale-95 select-none"
                    >
                        🗑️ Hapus Semua Log
                    </button>
                </div>
            </div>
        </div>

        <!-- GROUP 1: PROSES QURBAN -->
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Proses Qurban</h2>
                <div class="h-px bg-gray-200 dark:bg-gray-800 flex-grow"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- BLOCK 1: PENYEMBELIHAN -->
                @php $c1 = $colorMap[$color_block_1] ?? $colorMap['emerald']; @endphp
                <div class="border-t-4 {{ $c1['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c1['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c1['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c1['text'] }} uppercase tracking-wider">1. Penyembelihan</h3>
                        </div>
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
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Sapi</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_sapi_tersembelih'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_sapi_total'])
                        </div>
                        <hr class="border-gray-100 dark:border-gray-850">
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tersembelih', 'field' => 'penyembelihan_kambing_tersembelih'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penyembelihan_kambing_total'])
                        </div>
                    </div>
                </div>

                <!-- BLOCK 2: PENGELETAN -->
                @php $c2 = $colorMap[$color_block_2] ?? $colorMap['indigo']; @endphp
                <div class="border-t-4 {{ $c2['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c2['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c2['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c2['text'] }} uppercase tracking-wider">2. Pengeletan</h3>
                        </div>
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
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Sapi</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_sapi_terkelet'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_sapi_total'])
                        </div>
                        <hr class="border-gray-100 dark:border-gray-850">
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terkelet', 'field' => 'pengeletan_kambing_terkelet'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'pengeletan_kambing_total'])
                        </div>
                    </div>
                </div>

                <!-- BLOCK 3: PENIMBANGAN -->
                @php $c3 = $colorMap[$color_block_3] ?? $colorMap['violet']; @endphp
                <div class="border-t-4 {{ $c3['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c3['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c3['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c3['text'] }} uppercase tracking-wider">3. Penimbangan</h3>
                        </div>
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
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Sapi Reguler</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_reguler_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_reguler_total'])
                        </div>
                        <hr class="border-gray-100 dark:border-gray-850">
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Sapi Khusus (Super/Duper/PB)</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_sapi_khusus_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_sapi_khusus_total'])
                        </div>
                        <hr class="border-gray-100 dark:border-gray-850">
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Kambing</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Tertimbang', 'field' => 'penimbangan_kambing_tertimbang'])
                            @include('filament.pages.progress-input-row', ['label' => 'Total Target', 'field' => 'penimbangan_kambing_total'])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GROUP 2: DISTRIBUSI QURBAN -->
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Distribusi Qurban</h2>
                <div class="h-px bg-gray-200 dark:bg-gray-800 flex-grow"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- BLOCK 4: SOHIBUL QURBAN SAPI -->
                @php $c4 = $colorMap[$color_block_4] ?? $colorMap['rose']; @endphp
                <div class="border-t-4 {{ $c4['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden md:col-span-2 xl:col-span-1 transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c4['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c4['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c4['text'] }} uppercase tracking-wider">4. Sohibul Qurban Sapi</h3>
                        </div>
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
                        <button wire:click="updateBlock4FromDatabase" type="button" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 text-xs font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 active:scale-95 transition shadow-sm select-none">
                            🔄 Sinkronisasi Statistik dari Database Sohibul
                        </button>

                        <!-- Sapi Reguler -->
                        <div class="space-y-2 pt-2">
                            <div class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Sapi Reguler</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_reguler_terbungkus'])
                            
                            <div class="grid grid-cols-3 gap-2 pt-1">
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Total</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_reguler_total }}</div>
                                </div>
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Tidak Ambil</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_reguler_tidak_diambil }}</div>
                                </div>
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Terdistribusi</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_reguler_terdistribusi }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="border-gray-100 dark:border-gray-850">
                        
                        <!-- Sapi Khusus -->
                        <div class="space-y-2">
                            <div class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Sapi Khusus (Super/Duper/PB)</div>
                            @include('filament.pages.progress-input-row', ['label' => 'Terbungkus (Manual)', 'field' => 'sohibul_sapi_khusus_terbungkus'])
                            
                            <div class="grid grid-cols-3 gap-2 pt-1">
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Total</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_khusus_total }}</div>
                                </div>
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Tidak Ambil</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_khusus_tidak_diambil }}</div>
                                </div>
                                <div class="p-2 bg-gray-50 dark:bg-gray-950/40 rounded-lg text-center">
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">Terdistribusi</div>
                                    <div class="text-xs font-extrabold dark:text-white">{{ $sohibul_sapi_khusus_terdistribusi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BLOCK 5: SOHIBUL QURBAN KAMBING -->
                @php $c5 = $colorMap[$color_block_5] ?? $colorMap['amber']; @endphp
                <div class="border-t-4 {{ $c5['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c5['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c5['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c5['text'] }} uppercase tracking-wider">5. Sohibul Kambing</h3>
                        </div>
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
                @php $c6 = $colorMap[$color_block_6] ?? $colorMap['sky']; @endphp
                <div class="border-t-4 {{ $c6['border'] }} border-r border-b border-l rounded-xl bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden transition">
                    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-800 {{ $c6['bg'] }} flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $c6['dot'] }}"></span>
                            <h3 class="font-extrabold text-xs {{ $c6['text'] }} uppercase tracking-wider">6. Distribusi Daging</h3>
                        </div>
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
    </div>
</x-filament-panels::page>
