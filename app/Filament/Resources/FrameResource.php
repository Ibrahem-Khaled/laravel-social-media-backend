<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrameResource\Pages;
use App\Filament\Resources\FrameResource\RelationManagers;
use App\Models\Frame;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FrameResource extends Resource
{
    protected static ?string $model = Frame::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $activeNavigationIcon = 'heroicon-s-heart';

    protected static ?string $navigationGroup = 'Resources Management';


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 1 ? 'success' : 'warning';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->extraAttributes([
                                'class' => 'rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500',
                            ]),

                        Forms\Components\Card::make()
                            ->extraAttributes(['class' => 'bg-gray-50 p-6 rounded-lg shadow-lg border border-gray-200'])
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->required()
                                    ->disk('public_path')
                                    ->directory('images/frames')
                                    ->maxSize(2048)
                                ->hint('Maximum size: 2MB. Accepted formats: jpg, png, gif')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                                    ->label('Upload Image'),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Pricing Details')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->required()
                            ->numeric()
                            ->prefix('TUR')
                            ->extraAttributes([
                                'class' => 'rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500',
                            ]),

                        Forms\Components\DatePicker::make('expire')
                            ->label('Expiration Date')
                            ->date()
                            ->afterOrEqual(now()->addDays(1))
                            ->columnSpan('full'),
                    ])
                    ->collapsed(true)
                    ->collapsible(),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label('Active')
                            ->default(true)
                            ->required()
                            ->extraAttributes([
                                'class' => 'rounded-lg',
                            ]),
                    ])
                    ->collapsed(true)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('active')
                    ->label('Active'),


                Tables\Columns\ImageColumn::make('image_url')
                ->label('')
                ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),


                Tables\Columns\TextColumn::make('price')
                    ->money('Turkish Lira')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('expire')
                    ->label('Expiration Status')
                    ->getStateUsing(fn ($record) =>
                        !$record->expire
                            ? 'No Expiration Date'
                            : ($record->expire < now()
                                ? 'Expired on ' . $record->expire->format('Y-m-d')
                                : 'Valid until ' . $record->expire->format('Y-m-d'))
                    )
                    ->color(fn ($record) =>
                        !$record->expire
                            ? 'info'
                            : ($record->expire < now() ? 'danger' : 'success')
                    )
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('transactions_count')
                    ->label('Transactions')
                    ->sortable()
                    ->counts('transactions')
                    ->color(fn ($record) => $record->transactions_count > 0 ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->iconButton(),

                Tables\Actions\DeleteAction::make()
                ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordAction(null);
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
            'index' => Pages\ListFrames::route('/'),
            'create' => Pages\CreateFrame::route('/create'),
            // 'edit' => Pages\EditFrame::route('/{record}/edit'),
        ];
    }
}
