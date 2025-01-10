<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceOrderResource\Pages;
use App\Filament\Resources\ServiceOrderResource\RelationManagers;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceOrder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Models;
use App\Models\Brand;
use App\Models\TypeEquipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceOrderResource extends Resource
{
    protected static ?string $model = ServiceOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([
                Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\TextInput::make('code')
                    ->label('Codigo')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\DatePicker::make('date')
                    ->default(now())
                    ->label('Fecha')
                    ->required(),
                    Forms\Components\Select::make('responsibleTechnicial_id')
                    ->options(User::pluck('name', 'id'))
                    ->label('Responsable tecnico')
                    ->searchable()
                ]),
                
                Forms\Components\Select::make('customer_id')
                ->options(Customer::pluck('name', 'id'))
                ->label('Cliente')
                ->searchable()->createOptionForm([
                    Forms\Components\TextInput::make('document')
                        ->label('Documento')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telephone')
                        ->label('Telefono')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address')
                        ->label('Dirección')
                        ->required()
                        ->maxLength(255)
                        ])
                ->createOptionUsing(function (array $data) {
                    // Crear una nueva marca con los datos ingresados
                    $customer = Customer::create(['document' => $data['document'],
                    'telephone' => $data['telephone'],
                    'name' => $data['name'],
                    'address' => $data['address']]);
                    return $customer->id; // Devolver el ID de la nueva marca
                }),
                Forms\Components\TextInput::make('imei')
                    ->label('Imei')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Select::make('brand_id')
                        ->options(Brand::pluck('brand', 'id'))
                        ->label('Marca')
                        ->searchable()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('brand')
                                ->label('Marca')
                                ->required(),
                        ])
                        ->createOptionUsing(function (array $data) {
                            // Crear una nueva marca con los datos ingresados
                            $brand = Brand::create(['brand' => $data['brand']]);
                            return $brand->id; // Devolver el ID de la nueva marca
                        }),
                        Forms\Components\Select::make('model_id')
                        ->options(Models::pluck('model', 'id'))
                        ->label('Modelo')
                        ->searchable()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('model')
                                ->label('Modelo')
                                ->required(),
                        ])
                ->createOptionUsing(function (array $data) {
                    // Crear una nueva marca con los datos ingresados
                    $model = Models::create(['model' => $data['model']]);
                    return $model->id; // Devolver el ID de la nueva marca
                }),
                Forms\Components\Select::make('type_of_equipment_id')
                ->options(TypeEquipment::pluck('type_of_equipment', 'id'))
                ->label('Tipo de equipo')
                ->searchable()->createOptionForm([
                    Forms\Components\TextInput::make('type_of_equipment')
                        ->label('Tipo de equipo')
                        ->required(),
                ])
                ->createOptionUsing(function (array $data) {
                    // Crear una nueva marca con los datos ingresados
                    $typeEquipment = TypeEquipment::create(['type_of_equipment' => $data['type_of_equipment']]);
                    return $typeEquipment->id; // Devolver el ID de la nueva marca
                }),
                Forms\Components\Select::make('turn_on')
                ->options([
                    'Enciende',
                    'Si',
                    'No'
                ])
                ->label('Enciende')
                ->searchable()
                    ])
                
                ,
                Forms\Components\Select::make('blows')
                ->options([
                    'Golpes',
                    'Si',
                    'No'
                ])
                ->label('Golpes')
                ->searchable(),
                Forms\Components\Select::make('tactile')
                ->options([
                    'Táctil',
                    'Si',
                    'No'
                ])
                ->label('Táctil')
                ->searchable(),
                Forms\Components\Select::make('cargo_port')
                ->options(
                    ['Puerto carga',
                    'Si',
                    'No']
                )
                ->label('Puerto carga')
                ->searchable(),
                Forms\Components\ColorPicker::make('colour')
            ->label('Selecciona un color')
            ->default('#000000') // Valor por defecto
            ->required(), // Opcional, si es obligatorio
            Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->required()
                    ->maxLength(255),
                   
                    Forms\Components\Textarea::make('failure')
                    ->label('Especifique la falla de equipo')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Textarea::make('diagnosis')
                    ->label('Diagnóstico')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('budget')
                    ->label('Presupuesto')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('repair')
                    ->label('Refacción')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('advance')
                    ->label('Anticipo')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->maxLength(255)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('code')
                ->searchable()->label('Código'),
            TextColumn::make('customer.name')
                ->label('Cliente')->searchable(),
            TextColumn::make('user.name')
                ->label('Técnico')->searchable(),
            TextColumn::make('brand.brand')
                ->searchable()->label('Marca'),
            TextColumn::make('')
                ->label('')
                ->formatStateUsing(function ($state) {
                    return '<a href="https://wa.me/' . urlencode($state) . '" target="_blank">Contactar en WhatsApp</a>';
                })
                ->html(),
        ])
        ->filters([
            // Agrega aquí tus filtros si es necesario
        ])
        ->actions([
              // Acción global (para toda la tabla)
            
            Action::make('subirImagenes')
                ->label('Subir Imágenes')
                
                ->form([
                    FileUpload::make('nuevas_imagenes')
                        ->label('Nuevas Imágenes')
                        ->multiple() // Permitir subir varias imágenes
                        ->disk('public')
                        ->directory('imagenes'),
                ]),
                Action::make('imprimir')
                ->label('Imprimir')
                ->icon('heroicon-o-printer') // Ícono de impresora
                ->color('success') // Color verde para el botón
                ->action(function ($record) {
                    $printData = [
                        'Nombre' => $record->name,
                        'Correo Electrónico' => $record->email,
                    ];

                    // Pasar los datos al JavaScript
                    $this->emit('imprimirRegistro', $printData);
                }),
                Action::make('WP')
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                </svg>
                ')
                ->url(fn ($record) => 'https://wa.me/' . $record->phone . '?text=' . urlencode('Hola ' . $record->name . ', quiero más información.'))
                ->openUrlInNewTab(),
                Action::make('Vista previa PDF')
                ->icon('heroicon-o-printer')
                ->label('')
                    ->modalHeading('Vista Previa de Impresión')
                    
                    ->modalWidth('4xl')
                    
                    ->modalContent(function ($record) {
                        $pdf = Pdf::loadView('pdf.template', ['data' => $record]);
                        $filename = 'temp_pdf_preview.pdf';

                        // Guardar temporalmente el PDF
                        Storage::disk('public')->put($filename, $pdf->output());

                        // URL del archivo temporal
                        $url = Storage::url($filename);

                        // Mostrar el PDF en un iframe
                        return view('pdf-viewer', ['url' => $url]);
                    }),
                Tables\Actions\EditAction::make(),
            /*Action::make('estado')
            ->label('Status')
            ->form([
                Components\TextInput::make('code')
                    ->label('Código de orden')
                    ->disabled()
                    ->default(fn ($record) => $record ? $record->code : '0'),
                Components\Select::make('status')
                    ->options(
                        [
                            
                            'POR REPARAR',
                            'EN ESPERA',
                            'REPARADO',
                            'SIN REPARACIÓN',
                            'ENTREGADO',
                            'ENTREGADO SIN REPARAR'
                        ]
                    )
                    ->required(),
            ])*/
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
            'index' => Pages\ListServiceOrders::route('/'),
            'create' => Pages\CreateServiceOrder::route('/create'),
            'edit' => Pages\EditServiceOrder::route('/{record}/edit'),
        ];
    }
    protected function getFooterScripts(): array
{
    return [
        <<<JS
        document.addEventListener('alpine:init', () => {
            window.addEventListener('imprimirRegistro', (event) => {
                const datos = event.detail;

                // Crear contenido para imprimir
                const contenido = `
                    <div style="font-family: Arial, sans-serif; padding: 20px;">
                        <h1>Detalles del Registro</h1>
                        <p><strong>Nombre:</strong> ${datos.Nombre}</p>
                        <p><strong>Correo Electrónico:</strong> ${datos["Correo Electrónico"]}</p>
                    </div>
                `;

                // Abrir ventana de impresión
                const ventanaImpresion = window.open('', '_blank');
                ventanaImpresion.document.open();
                ventanaImpresion.document.write(`
                    <html>
                        <head>
                            <title>Imprimir Registro</title>
                        </head>
                        <body>${contenido}</body>
                    </html>
                `);
                ventanaImpresion.document.close();
                ventanaImpresion.print();
            });
        });
        JS,
    ];
}

}
