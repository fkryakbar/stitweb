<?php

namespace App\Filament\Widgets;

use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Cache;

class ClearCacheButton extends Widget
{
    protected static string $view = 'filament.widgets.clear-cache-button';


    public function clear()
    {
        Cache::flush();
        Notification::make()
            ->title('Caches cleared successfully')
            ->success()
            ->send();
    }
}
