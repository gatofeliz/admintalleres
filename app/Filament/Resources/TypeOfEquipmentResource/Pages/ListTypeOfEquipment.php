<?php

namespace App\Filament\Resources\TypeOfEquipmentResource\Pages;

use App\Filament\Resources\TypeOfEquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeOfEquipment extends ListRecords
{
    protected static string $resource = TypeOfEquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
