<?php

namespace App\Filament\Resources\ServiceOrderResource\Pages;

use Filament\Actions;
use App\Models\ServiceOrder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ServiceOrderResource;

class CreateServiceOrder extends CreateRecord
{
    protected static string $resource = ServiceOrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $actualOrderServicesCount = ServiceOrder::all()->count();
        $data['code'] = str_pad($actualOrderServicesCount + 1, 6, "0", STR_PAD_LEFT);
        ;
        $data['total'] = $data['budget'] - $data['advance'];

        return $data;
    }
}
