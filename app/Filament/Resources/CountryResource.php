<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

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

                Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Country Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter the country name')
                            ->unique('countries', 'name', ignoreRecord: true)
                            ->columnSpan(1),

                        TextInput::make('cca2')
                            ->label('CCA2 Code')
                            ->required()
                            ->maxLength(2)
                            ->placeholder('Enter the 2-character country code (CCA2)')
                            ->unique('countries', 'cca2', ignoreRecord: true)
                            ->columnSpan(1),

                        TextInput::make('country_code')
                            ->label('Country Code')
                            ->required()
                            ->maxLength(5)
                            ->placeholder('Enter the country calling code')
                            ->unique('countries', 'country_code', ignoreRecord: true)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(false),


                Section::make('Flag Upload')
                    ->schema([
                        FileUpload::make('flag')
                            ->label('Country Flag')
                            ->required()
                            ->image()
                            ->disk('public_path')
                            ->directory('images/countries')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                            ->hint('Maximum size: 2MB. Accepted formats: jpg, png, gif'),
                    ])
                    ->collapsible()
                    ->collapsed(true),


                Section::make('Status')
                    ->schema([
                        Toggle::make('status')
                            ->label('Active Status')
                            ->required()
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),
                    ])
                    ->collapsible()
                    ->collapsed(true),
                ]);
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

                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('cca2')
                ->label('CCA2')
                ->searchable(),

                Tables\Columns\TextColumn::make('country_code')
                ->searchable(),

                Tables\Columns\BadgeColumn::make('users_count')
                ->label('Users')
                ->counts('users')
                ->color(fn ($record) => $record->users_count > 0 ? 'success' : 'danger')
                ->sortable(),

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
                ->icon('heroicon-o-trash')
                ->iconButton()
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            // 'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
