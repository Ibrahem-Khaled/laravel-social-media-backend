<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftResource\Pages;
use App\Filament\Resources\GiftResource\RelationManagers;
use App\Models\Gift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\HtmlColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class GiftResource extends Resource
{
    protected static ?string $model = Gift::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

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
                // Main Details Section
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Main Details')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Gift Title'),

                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->step(0.01) // Allows decimal values
                                    ->prefix('TUR')
                                    ->label('Price'),
                            ])
                            ->collapsed(false), // This section is expanded by default
                    ]),

                // Media Upload Section
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Upload Image')
                                    ->image()
                                    ->required()
                                    ->disk('public_path')
                                    ->directory('images/gifts')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                                    ->hint('Maximum size: 2MB. Formats: jpg, png, gif'),

                                Forms\Components\FileUpload::make('video')
                                    ->label('Upload Video')
                                    ->required()
                                    ->disk('public_path')
                                    ->directory('videos/gifts')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mov' , 'image/gif'])
                                    ->hint('Maximum size: 2MB. Formats: mp4, avi, mov, gif'),
                            ])
                            ->collapsed(true), // This section is collapsed by default
                    ]),

                // Status Section
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Active Status')
                                    ->default(true)
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->required(),
                            ])
                            ->collapsed(true), // This section is collapsed by default
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('')
                    ->circular(),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('')
                    ->onColor('success')
                    ->offColor('danger'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('video')
                ->boolean(),

                Tables\Columns\TextColumn::make('price')
                    ->money('Turkish Lira')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('giftings_count')
                    ->label('Gifting Time')
                    ->sortable()
                    ->counts('giftings')
                    ->color(fn ($record) => $record->giftings_count > 0 ? 'success' : 'danger'),

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
            'index' => Pages\ListGifts::route('/'),
            'create' => Pages\CreateGift::route('/create'),
            'edit' => Pages\EditGift::route('/{record}/edit'),
        ];
    }
}
