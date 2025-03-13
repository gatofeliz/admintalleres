<?php

namespace App\Filament\Resources\ServiceOrderResource\Pages;

use Filament\Infolists;
use Filament\Tables\Table;
use App\Models\ServiceOrder;
use Filament\Infolists\Infolist;
use Filament\Tables\Contracts\HasTable;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Concerns\HasColumns;
use App\Filament\Resources\ServiceOrderResource;
use Filament\Tables\Concerns\InteractsWithTable;

class StatusServiceOrder extends ViewRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = ServiceOrderResource::class;

    protected static string $view = 'filament.resources.service-order-resource.pages.status-service-order';

    protected static ?string $title = 'Estado del servicio';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('failure')->label('Falla'),
                Infolists\Components\ImageEntry::make('photos')->label('Fotos'),
                Infolists\Components\TextEntry::make('date')->label('Fecha de recepción'),
                Infolists\Components\TextEntry::make('total')->label('Total a pagar'),
                Infolists\Components\TextEntry::make('status')->label('Estatus'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ServiceOrder::query())
            ->viewData($this->record->toArray())
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('code')
                    ->label('Código'),
                \Filament\Tables\Columns\TextColumn::make('customer.name')
                    ->label('Cliente'),
                \Filament\Tables\Columns\TextColumn::make('brand.brand')
                    ->label('Marca'),
                \Filament\Tables\Columns\TextColumn::make('model.model')
                    ->label('Modelo'),
            ])
            ->paginated(false)
        ;
    }
}
