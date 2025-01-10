<?php

namespace App\Filament\Resources\TypeOfEquipmentResource\Pages;

use App\Filament\Resources\TypeOfEquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeOfEquipment extends EditRecord
{
    protected static string $resource = TypeOfEquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
