<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;
    protected static ?string $label = 'Inventario';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->options(Category::pluck('category', 'id'))
                    ->label('Categoria')
                    ->searchable()
                    ->createOptionForm([
                    Forms\Components\TextInput::make('category')
                        ->label('Categoria')
                        ->required(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        // Crear una nueva marca con los datos ingresados
                        $category = Category::create(['category' => $data['category']]);
                        return $category->id; // Devolver el ID de la nueva marca
                    }),
                Forms\Components\TextInput::make('bar_code')
                    ->label('Barcode')
                    ->maxLength(255)
                    ->default('barcode'),
                 // Si deseas que sea obligatorio
                Forms\Components\TextInput::make('serie')
                    ->label('Serie')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->maxLength(10),
                Forms\Components\Select::make('supplier_id')
                    ->label('Proveedor')
                    ->searchable()
                    ->relationship('supplier', 'name')
                    ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label('Nombre')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('document')
                                ->label('Documento')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('telephone')
                                ->label('Teléfono')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('address')
                                ->label('Dirección')
                                ->required()
                                ->maxLength(255),
                        ]),
                Forms\Components\TextInput::make('purchase_price')
                    ->label('Precio de compra')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('sale_price')
                    ->label('Precio de venta')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('wholesale_price')
                    ->label('Precio Mayoreo')
                    ->required()
                    ->maxLength(10),
                FileUpload::make('photo') // 'document' es el nombre del campo en la base de datos
                    // Asegúrate de que 'name' no sea null
                   ->label('Documento')
                   ->image() // Puedes usar 'image()' si es una imagen
                   ->disk('public') // Almacena en el disco 'public' configurado en config/filesystems.php
                   ->directory('documents') // Dirección dentro del almacenamiento para organizar los archivos
                   ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo') // Muestra la imagen
                ->label('Imagen')
                ->square() // Hace que la imagen sea cuadrada
                ->size(50),

                    Tables\Columns\TextColumn::make('description')
                    ->searchable()->label('Descripción'),
                    Tables\Columns\TextColumn::make('stock')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('purchase_price')
                    ->searchable()->label('Precio de compra'),

                    Tables\Columns\TextColumn::make('sale_price')
                    ->searchable()->label('Precio de venta'),
                    Tables\Columns\TextColumn::make('wholesale_price')
                    ->searchable()->label('Precio de mayoreo'),
                    Tables\Columns\TextColumn::make('serie')
                    ->searchable()->label('Serie'),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
