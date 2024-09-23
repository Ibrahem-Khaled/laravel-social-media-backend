<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

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
                        Grid::make(1)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->placeholder('Enter the name')
                                    ->required()
                                    ->columnSpan(1),
                            ]),

                        Toggle::make('status')
                            ->label('Active Status')
                            ->inline(false)
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Section::make('Image Upload')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->disk('public_path')
                            ->directory('images/categories')
                            ->maxSize(2048)
                            ->hint('Maximum size: 2MB. Accepted formats: jpg, jpeg, png, gif')
                            ->acceptedFileTypes(['image/jpeg','image/jpg', 'image/png', 'image/gif']),
                    ])
                    ->collapsible()
                    ->collapsed(true)
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

                Tables\Columns\BadgeColumn::make('rooms_count')
                    ->label('Rooms')
                    ->sortable()
                    ->counts('rooms')
                    ->color(fn ($record) => $record->rooms_count > 0 ? 'success' : 'danger'),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            // 'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
