<?php

namespace App\Filament\Resources;

use App\Exports\PackagesExport;
use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Store')
                        ->icon('heroicon-m-building-storefront')
                        ->description('Select the store.')
                        ->schema([
                            Select::make('store_id')
                                ->label('Store')
                                ->relationship('store', 'name')
                                ->searchable()
                                ->preload()
                                ->selectablePlaceholder(false)
                                ->required(),
                        ]),
                    Wizard\Step::make('Package Details')
                        ->icon('heroicon-m-cube')
                        ->schema([
                            Section::make('Package')->schema([
                                TextInput::make('name')
                                    ->label('Package Name')
                                    ->required(),

                                TextInput::make('price')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('weight')
                                    ->numeric()
                                    ->required(),
                            ]),

                            Section::make('Extra')
                                ->description('I know that some fields here should be auto calculated, but unfortunately I don\'t have the logic to do that.')
                                ->schema([
                                    Toggle::make('can_be_opened')
                                        ->label('Can Be Opened'),

                                    TextInput::make('commission')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('extra_weight_price')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('packaging_price')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('partner_cod_price')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('partner_return')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('price_to_pay')
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('total_price')
                                        ->numeric()
                                        ->required(),
                                ]),
                        ]),
                    Wizard\Step::make('Delivery')
                        ->icon('heroicon-m-map-pin')
                        ->schema([
                            Select::make('commune_id')
                                ->label('Commune')
                                ->relationship('commune', 'name')
                                ->searchable()
                                ->preload()
                                ->selectablePlaceholder(false)
                                ->required(),

                            Select::make('delivery_type_id')
                                ->label('Delivery Type')
                                ->relationship('deliveryType', 'name')
                                ->default('3')
                                ->searchable()
                                ->preload()
                                ->selectablePlaceholder(false)
                                ->required(),

                            TextInput::make('address')
                                ->required(),

                            Toggle::make('free_delivery')
                                ->label('Free Delivery')
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if ($state) {
                                        $set('delivery_price', 0);
                                    }
                                }),

                            TextInput::make('delivery_price')
                                ->label('Delivery Price')
                                ->required()
                                ->numeric()
                                ->disabled(fn(callable $get) => $get('free_delivery')),

                            TextInput::make('partner_delivery_price')
                                ->numeric()
                                ->required(),

                            TextInput::make('return_price')
                                ->numeric()
                                ->required(),
                        ]),

                    Wizard\Step::make('Client Details')
                        ->icon('heroicon-m-user')
                        ->schema([
                            TextInput::make('client_first_name')
                                ->label('Client First Name')
                                ->required(),

                            TextInput::make('client_last_name')
                                ->label('Client Last Name')
                                ->required(),

                            TextInput::make('client_phone')
                                ->label('Client Phone')
                                ->required(),

                            TextInput::make('client_phone2')
                                ->label('Client Phone 2')
                                ->required(),
                        ]),
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('store.name')
                    ->label('Store Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Package Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status.id')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_first_name')
                    ->label('Client Full Name')
                    ->formatStateUsing(fn($record) => $record->client_first_name . ' ' . $record->client_last_name)
                    ->searchable()
                    ->formatStateUsing(fn($record) => $record->client_first_name . ' ' . $record->client_last_name),
                Tables\Columns\TextColumn::make('client_phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commune.wilaya.name')
                    ->label('Wilaya')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commune.name')
                    ->label('Commune')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deliveryType.name')
                    ->label('Delivery Type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status Name')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Label Created' => 'info',
                        'Picked Up' => 'info',
                        'In Transit' => 'gray',
                        'Out For Delivery' => 'gray',
                        'Delivered' => 'success',
                        'Delivery Attempt Failed' => 'danger',
                        'Returned To Sender' => 'info',
                        'Delayed' => 'warning',
                        'Lost' => 'danger',
                        'Damaged' => 'danger',
                        'Held At Location' => 'gray',
                        'Awaiting Pickup' => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options([
                        1 => 'Label Created',
                        2 => 'Picked Up',
                        3 => 'In Transit',
                        4 => 'Out For Delivery',
                        5 => 'Delivered',
                        6 => 'Delivery Attempt Failed',
                        7 => 'Returned To Sender',
                        8 => 'Delayed',
                        9 => 'Lost',
                        10 => 'Damaged',
                        11 => 'Held At Location',
                        12 => 'Awaiting Pickup',
                    ])
                    ->placeholder('Select Status'),

                SelectFilter::make('wilaya_id')
                    ->label('Wilaya')
                    ->relationship('commune.wilaya', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Select Wilaya'),

                SelectFilter::make('commune_id')
                    ->label('Commune')
                    ->relationship('commune', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Select Commune'),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('Export all packages')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->form([
                        Select::make('file_type')
                            ->label('File Type')
                            ->default('xlsx')
                            ->selectablePlaceholder(false)
                            ->options([
                                'csv' => 'CSV',
                                'xlsx' => 'Excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $file = Excel::download(new PackagesExport, 'packages.' . $data['file_type']);

                        Notification::make()
                            ->title('Download started')
                            ->success()
                            ->body('The download should be started in a few seconds.')
                            ->send();

                        return $file;
                    })
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'view' => Pages\ViewPackage::route('/{record}'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
