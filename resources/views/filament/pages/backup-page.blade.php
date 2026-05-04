<x-filament-panels::page>
    <style>
        .b-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .b-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .b-header-blue { background: linear-gradient(90deg, #eff6ff, #dbeafe); border-color: #bfdbfe; }
        .b-header-orange { background: linear-gradient(90deg, #fff7ed, #ffedd5); border-color: #fed7aa; }
        
        .b-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .b-icon-blue { background: #3b82f6; color: #fff; }
        .b-icon-orange { background: #f59e0b; color: #fff; }

        .b-title { font-size: 15px; font-weight: 700; color: #1e293b; }
        .b-subtitle { font-size: 12px; color: #64748b; margin-top: 1px; }

        .b-content { padding: 20px; flex-grow: 1; }
        
        .b-list { list-style: none; padding: 0; margin: 0 0 20px 0; }
        .b-list li { 
            font-size: 13px; 
            color: #475569; 
            padding: 6px 0; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
        }
        .b-list li::before { content: "✓"; color: #10b981; font-weight: 900; }

        .b-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }
        .b-btn-blue { background: #2563eb; color: #fff; }
        .b-btn-blue:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); }
        
        .b-btn-orange { background: #ea580c; color: #fff; }
        .b-btn-orange:hover { background: #c2410c; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(234, 88, 12, 0.2); }
        .b-btn-orange:disabled { background: #94a3b8; cursor: not-allowed; transform: none; box-shadow: none; }

        .b-info {
            margin-top: 24px;
            padding: 14px 18px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: flex;
            gap: 12px;
        }
        .b-info-icon { color: #64748b; font-size: 18px; flex-shrink: 0; }
        .b-info-text { font-size: 12px; color: #475569; line-height: 1.5; font-style: italic; }
        .b-info-text strong { color: #1e293b; }
        .b-info-text code { background: #e2e8f0; padding: 1px 4px; border-radius: 4px; font-family: monospace; }
    </style>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
        
        {{-- Card Backup --}}
        <div class="b-card">
            <div class="b-header b-header-blue">
                <div class="b-icon-box b-icon-blue">
                    <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                </div>
                <div>
                    <div class="b-title">Cadangkan Data (Backup)</div>
                    <div class="b-subtitle">Unduh salinan database & file kwitansi</div>
                </div>
            </div>
            <div class="b-content">
                <ul class="b-list">
                    <li>Database (SQLite, MySQL, atau PostgreSQL)</li>
                    <li>Folder Kwitansi (storage/kwitansi)</li>
                    <li>Format Paket: Kompresi ZIP</li>
                </ul>
                <button wire:click="downloadBackup" class="b-btn b-btn-blue">
                    <svg style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download Full Backup
                </button>
            </div>
        </div>

        {{-- Card Restore --}}
        <div class="b-card">
            <div class="b-header b-header-orange">
                <div class="b-icon-box b-icon-orange">
                    <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <div>
                    <div class="b-title">Pulihkan Data (Restore)</div>
                    <div class="b-subtitle">Kembalikan data dari cadangan ZIP</div>
                </div>
            </div>
            <div class="b-content">
                <form wire:submit="restoreBackup">
                    <div style="margin-bottom: 20px;">
                        {{ $this->form }}
                    </div>
                    <button type="submit" class="b-btn b-btn-orange" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <svg style="width: 18px; height: 18px; display: inline; vertical-align: middle; margin-right: 4px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mulai Restore Sekarang
                        </span>
                        <span wire:loading>Memproses Restore...</span>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <div class="b-info">
        <div class="b-info-icon">ℹ️</div>
        <div class="b-info-text">
            <strong>Catatan:</strong> Proses restore akan menggantikan data aktif secara permanen. 
            Sistem mendukung pemulihan untuk <strong>SQLite, MySQL, dan PostgreSQL</strong>. 
            Jika menggunakan SQLite, sistem mencadangkan database lama Anda sebagai <code>database.sqlite.bak</code>. 
            Pastikan file ZIP yang diunggah adalah hasil backup resmi dari aplikasi ini.
        </div>
    </div>
</x-filament-panels::page>
