<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeOfEquipmentResource\Pages;
use App\Filament\Resources\TypeOfEquipmentResource\RelationManagers;
use App\Models\TypeEquipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeOfEquipmentResource extends Resource
{
    protected static ?string $model = TypeEquipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type_of_equipment')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type_of_equipment')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeOfEquipment::route('/'),
            'create' => Pages\CreateTypeOfEquipment::route('/create'),
            'edit' => Pages\EditTypeOfEquipment::route('/{record}/edit'),
        ];
    }
}
