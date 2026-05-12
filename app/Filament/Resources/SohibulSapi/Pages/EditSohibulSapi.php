<?php

namespace App\Filament\Resources\SohibulSapi\Pages;

use App\Filament\Resources\SohibulSapi\SohibulSapiResource;
use Filament\Resources\Pages\EditRecord;

class EditSohibulSapi extends EditRecord
{
    protected static string $resource = SohibulSapiResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);
    }

    protected function getRedirectUrl(): string
    {
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
