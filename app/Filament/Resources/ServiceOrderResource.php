<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ServiceOrder;
use App\Models\TypeEquipment;
use Filament\Forms\Components;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceOrderResource\Pages;
use App\Filament\Resources\ServiceOrderResource\RelationManagers;

class ServiceOrderResource extends Resource
{
    protected static ?string $model = ServiceOrder::class;
    protected static ?string $label = 'Orden de servicio';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                ->options([
                    'por-reparar' => 'POR REPARAR',
                    'en-espera' => 'EN ESPERA',
                    'reparado' => 'REPARADO',
                    'sin-reparación' => 'SIN REPARACIÓN',
                    'entregado' => 'ENTREGADO',
                    'entregado-sin-reparar' => 'ENTREGADO SIN REPARAR'
                ])
                ->required(),
                Forms\Components\Grid::make(3)
                ->schema([
                    Forms\Components\TextInput::make('code')
                    ->label('Codigo')
                    ->required()
                    ->maxLength(255)
                    ->default(uniqid()),
                    Forms\Components\DatePicker::make('date')
                    ->default(now())
                    ->label('Fecha')
                    ->required(),
                    Forms\Components\Hidden::make('responsibleTechnicial_id')
                        ->default(1),
                    Forms\Components\TextInput::make('tech')
                        ->label('Responsable tecnico')
                        ->required()
                        ->maxLength(255),
                ]),
                Forms\Components\Select::make('customer_id')
                ->options(Customer::pluck('name', 'id'))
                ->label('Cliente')
                ->required()
                ->searchable()->createOptionForm([
                    Forms\Components\Hidden::make('document')
                    ->default('documento'),
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
                        ->required()
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
                        ->required()
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
                ->required()
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
                    'si' => 'Si',
                    'no' => 'No',
                ])
                ->required()
                ->label('Enciende')
                ->searchable()
                    ])
                ,
                Forms\Components\Select::make('blows')
                ->options([
                    'si' => 'Si',
                    'no' => 'No',
                ])
                ->required()
                ->label('Golpes')
                ->searchable(),
                Forms\Components\Select::make('tactile')
                ->options([
                    'si' => 'Si',
                    'no' => 'No',
                ])
                ->label('Táctil')
                ->required()
                ->searchable(),
                Forms\Components\Select::make('cargo_port')
                ->options([
                    'si' => 'Si',
                    'no' => 'No',
                ])
                ->required()
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
                    ->maxLength(255)
                    ->default(0),
                    Forms\Components\TextInput::make('repair')
                    ->label('Refacción')
                    ->required()
                    ->maxLength(255)
                    ->default(0),
                    Forms\Components\TextInput::make('advance')
                    ->label('Anticipo')
                    ->required()
                    ->maxLength(255)
                    ->default(0),
                    Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required()
                    ->maxLength(255)
                    ->default(0),
            Forms\Components\FileUpload::make('photos')
                ->image()
                ->multiple()
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
        ->defaultSort('id', 'desc')
        ->filters([
            // Agrega aquí tus filtros si es necesario
        ])
        ->actions([
            Tables\Actions\Action::make('upload-photos')
            ->label('Fotos')
            ->form([
                FileUpload::make('photos')
                    ->label('Fotos')
                    ->multiple()
            ])
            ->action(function (ServiceOrder $record, array $data) {
                $recordPhotos = $record->photos;
                if (is_string($recordPhotos) && empty($recordPhotos)) {
                    $recordPhotos = [];
                }

                $record->update([
                    'photos' => array_merge($data['photos'], $recordPhotos),
                ]);
            }),
            Action::make('change-status')
            ->label('Estatus')
            ->form([
                Components\Select::make('status')
                    ->options(
                        [
                            'por-reparar' => 'POR REPARAR',
                            'en-espera' => 'EN ESPERA',
                            'reparado' => 'REPARADO',
                            'sin-reparación' => 'SIN REPARACIÓN',
                            'entregado' => 'ENTREGADO',
                            'entregado-sin-reparar' => 'ENTREGADO SIN REPARAR'
                        ]
                    )
                    ->default(fn ($record) => $record?->status)
                    ->required(),
            ])
            ->action(function (ServiceOrder $record, array $data) {
                $record->update([
                    'status' => $data['status'],
                ]);
            }),
            Action::make('Wa')
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->url(fn ($record) => 'https://web.whatsapp.com/send?phone=+52'.$record->customer->telephone.'&text=' . rawurlencode(
                    '¡Saludos!👋🏼 
 
                    Estimad@ '.$record->customer->name.' ' .$record->customer->lastname.'  ☺️ hemos recibido su equipo en nuestras instalaciones! 📬
                    
                    ⚙️Reparación: #'.$record->code.'
                    🔍Equipo: CELULAR 
                    🔢Modelo: '.$record->brand->brand.''.$record->model->model.''.

                   '#️⃣Serial: 
                    
                    ❓Motivo del ingreso: 
                    💡Estado Actual: '.$record->status.'
                    
                    📌Se informará por este medio el estado de su equipo o puede consultar en tiempo real, escaneando el código QR del documento entregado. 
                     
                    Gracias por su confianza!✨ 
                     
                    CONSUME 📱'
                
                )
)
                ->openUrlInNewTab(),
            Action::make('Imprimir')
                ->icon('heroicon-o-printer')
                ->label('Documento')
                ->modalHeading('Documento')
                ->modalWidth('4xl')
                ->modalContent(function ($record) {
                    $qrPath = sprintf('%s/%s.png', public_path(), $record->code);
                    $route = static::getUrl('status', ['record' => $record], true, 'guest');
                    QrCode::size(100)->format('png')->generate($route, $qrPath);
                    $pdfName = sprintf('order-doc-%s.pdf', $record->code);
                    Pdf::loadView('pdf.order', ['data' => $record, 'qrPath' => $qrPath])
                        ->setPaper('A4', 'portrait')
                        ->save($pdfName);
                    $url = sprintf('/%s', $pdfName);
                    return view('pdf-viewer', [
                        'url' => $url,
                        'qrPath' => $qrPath,
                    ]);
                }),
            Action::make('ticket')
                ->icon('heroicon-o-ticket')
                ->label('Ticket')
                ->modalHeading('Vista Previa')
                ->modalWidth('4xl')
                ->modalContent(function ($record) {
                    $qrPath = sprintf('%s/%s.png', public_path(), $record->code);
                    $route = static::getUrl('status', ['record' => $record], true, 'guest');
                    $qrCode = QrCode::size(100)->format('png')->generate($route, $qrPath);
                    $pdfName = sprintf('order-ticket-%s.pdf', $record->code);
                    Pdf::loadView('pdf.ticket', ['data' => $record, 'qrPath' => $qrPath])
                        ->setPaper([0, 0, 207.2125984252, 842.1732283465], 'portrait')
                        ->save($pdfName);
                    $url = sprintf('/%s', $pdfName);

                    return view('pdf-viewer', ['url' => $url]);
                }),
            Action::make('stamp')
                ->icon('heroicon-o-device-phone-mobile')
                ->label('Estampa')
                ->modalHeading('Estampa')
                ->modalWidth('4xl')
                ->modalContent(function ($record) {
                    $pdfName = sprintf('order-stamp-%s.pdf', $record->code);
                    Pdf::loadView('pdf.stamp', ['data' => $record])
                        ->setPaper([0, 0, 207.2125984252, 842.1732283465], 'landscape')
                        ->save($pdfName);
                    $url = sprintf('/%s', $pdfName);

                    return view('pdf-viewer', ['url' => $url]);
                }),
            Tables\Actions\EditAction::make()->label(''),
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
        ];
    }
    protected function getFooterScripts(): array
    {
        // todo: remove
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
