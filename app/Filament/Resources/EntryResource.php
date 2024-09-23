<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryResource\Pages;
use App\Filament\Resources\EntryResource\RelationManagers;
use App\Models\Entry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

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
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disk('public_path')
                            ->directory('images/entries')
                            ->hint('Maximum size: 2MB. Accepted formats: jpg, png, gif')
                            ->columnSpan('full'),
                    ])
                    ->collapsed(false)
                    ->collapsible(),

                Forms\Components\Section::make('Pricing Details')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->required()
                            ->numeric()
                            ->prefix('TUR')
                            ->columnSpan('full'),
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
                        Forms\Components\Toggle::make('status')
                            ->label('Active Status')
                            ->required()
                            ->default(true)
                            ->columnSpan('full'),
                    ])
                    ->collapsed(true)
                    ->collapsible(),
            ])
            ->columns(1);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('status')
                    ->label(''),

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
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntry::route('/create'),
            // 'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }

    public static function query(): Builder
    {
        return parent::query()
            ->withCount('transactions');
    }

}
