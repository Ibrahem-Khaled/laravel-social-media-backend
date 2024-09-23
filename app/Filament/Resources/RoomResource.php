<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Rooms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;

class RoomResource extends Resource
{
    protected static ?string $model = Rooms::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';

    protected static ?string $activeNavigationIcon = 'heroicon-s-heart';

    protected static ?string $navigationGroup = 'Users Managment';

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
            Forms\Components\Section::make('Details')
                ->schema([

                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter name')
                        ->columnSpan(1),

                    Select::make('user_id')
                        ->label('Creator')
                        ->relationship('user', 'name') // Assuming user relationship
                        ->searchable()
                        ->required()
                        ->placeholder('Select creator')
                        ->columnSpan(1),

                    Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name') // Assuming category relationship
                        ->searchable()
                        ->required()
                        ->placeholder('Select category')
                        ->columnSpan(1),
                ])
                ->columns(3),

            Forms\Components\Section::make('Media')
                ->schema([
                    FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->disk('public_path')
                        ->directory('images/rooms')
                        ->required()
                        ->maxSize(2048)
                        ->hint('Accepted formats: jpg, png, gif. Max size: 2MB')
                        ->columnSpan('full'), // Make image upload span full width
                ])
                ->collapsed()
                ->collapsible(),

            Forms\Components\Section::make('Security')
                ->schema([

                    TextInput::make('password')
                        ->label('Password')
                        ->nullable()
                        ->minLength(8)
                        ->maxLength(255)
                        ->hint('Leave empty to keep current password')
                        ->columnSpan('full'),

                    Toggle::make('status')
                        ->label('Status')
                        ->default(true)
                        ->inline(false)
                        ->required(),
                ])
                ->columns(1)
                ->collapsed()
                ->collapsible(),
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
                ->label(''),

                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                ->label('Creator')
                ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->badge()
                ->color('info')
                ->searchable(),


                Tables\Columns\TextColumn::make('password')
                ->label('Password')
                ->getStateUsing(fn($record) => !empty($record->password) ? $record->password : 'No Password')
                ->badge()
                ->color(fn($record) => !empty($record->password) ? 'gray' : 'success')
                ->searchable(),


                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Activity')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Filter::make('Disabled')
                    ->query(fn (Builder $query) => $query->where('status', false)),

                Filter::make('With Password')
                    ->query(fn (Builder $query) => $query->whereNotNull('password')),

                Filter::make('Without Password')
                    ->query(fn (Builder $query) => $query->whereNull('password')),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }




    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
