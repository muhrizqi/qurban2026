<?php

namespace App\Filament\Resources\SohibulSapi\Pages;

use App\Filament\Resources\SohibulSapi\SohibulSapiResource;
use App\Models\SohibulSapi;
use Filament\Resources\Pages\CreateRecord;

class CreateSohibulSapi extends CreateRecord
{
    protected static string $resource = SohibulSapiResource::class;

    /**
     * Pre-fill jenis, no_sohibul & nilaisepertuju dari URL query param ?jenis=REGULER
     */
    public function mount(): void
    {
        parent::mount();

        $jenis = request()->query('jenis');

        if ($jenis && array_key_exists($jenis, SohibulSapi::JENIS_OPTIONS)) {
            $this->form->fill([
                'jenis'          => $jenis,
                'no_sohibul'     => SohibulSapi::nextNoSohibul($jenis),
                'nilaisepertuju' => SohibulSapi::NILAI_DEFAULT[$jenis] ?? null,
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        $jenis = $this->record->jenis ?? null;

        return match ($jenis) {
            'REGULER' => SohibulSapiResource::getUrl('reguler'),
            'SUPER'   => SohibulSapiResource::getUrl('super'),
            'DUPER'   => SohibulSapiResource::getUrl('duper'),
            'PRIBADI' => SohibulSapiResource::getUrl('pribadi'),
            default   => SohibulSapiResource::getUrl('reguler'),
        };
    }
}
