<?php

namespace App\Filament\Resources\PostsResource\Pages;

use App\Filament\Resources\PostsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ManagePosts extends ManageRecords
{
    protected static string $resource = PostsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    Cache::flush();

                    $data['slug'] = Str::slug($data['title']);

                    return $data;
                }),
        ];
    }
}
