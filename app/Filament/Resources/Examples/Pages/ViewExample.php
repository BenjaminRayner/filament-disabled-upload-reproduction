<?php

namespace App\Filament\Resources\Examples\Pages;

use App\Filament\Resources\Examples\ExampleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExample extends ViewRecord
{
    protected static string $resource = ExampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
