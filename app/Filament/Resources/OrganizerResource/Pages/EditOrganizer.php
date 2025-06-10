<?php

namespace App\Filament\Resources\OrganizerResource\Pages;

use App\Filament\Resources\OrganizerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizer extends EditRecord
{
    protected static string $resource = OrganizerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
