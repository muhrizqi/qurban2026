<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function mount(): void
    {
        if (auth()->user()?->hasRole('adminprogres')) {
            // Redirect to the progress report admin page
            redirect(ProgressAdmin::getUrl());
        }
    }
}
