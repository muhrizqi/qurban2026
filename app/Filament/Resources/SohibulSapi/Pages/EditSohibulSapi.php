<?php

namespace App\Filament\Resources\SohibulSapi\Pages;

use App\Filament\Resources\SohibulSapi\SohibulSapiResource;
use Filament\Resources\Pages\EditRecord;

class EditSohibulSapi extends EditRecord
{
    protected static string $resource = SohibulSapiResource::class;

    /**
     * Simpan URL halaman sebelumnya (referrer) ke session saat form edit dibuka.
     * Ini agar setelah save kita bisa kembali ke halaman yang sama,
     * bukan selalu ke halaman list berdasarkan jenis.
     */
    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Simpan referrer ke session — gunakan URL sebelumnya jika bukan halaman edit itu sendiri
        $referrer = url()->previous();
        $current  = url()->current();

        if ($referrer && $referrer !== $current && ! str_contains($referrer, '/edit')) {
            session(['sohibul_edit_redirect' => $referrer]);
        }
    }

    protected function getRedirectUrl(): string
    {
        // Kembali ke halaman terakhir yang dibuka sebelum masuk ke form edit
        $back = session()->pull('sohibul_edit_redirect');
        if ($back) {
            return $back;
        }

        // Fallback: kembali ke list sesuai jenis sohibul
        $jenis = $this->record->jenis ?? null;
        $map   = [
            'REGULER' => SohibulSapiResource::getUrl('reguler'),
            'SUPER'   => SohibulSapiResource::getUrl('super'),
            'DUPER'   => SohibulSapiResource::getUrl('duper'),
            'PRIBADI' => SohibulSapiResource::getUrl('pribadi'),
        ];
        return $map[$jenis] ?? SohibulSapiResource::getUrl('reguler');
    }
}
