<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

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
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2), // 2 columns

                        Textarea::make('body')
                            ->label('Body')
                            ->required()
                            ->rows(5)
                            ->placeholder('Enter the body content here...'),
                    ])
                    ->columns(2), // Lay out in 2 columns

                Forms\Components\Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disk('public_path')
                            ->directory('images/posts')
                            ->required()
                            ->maxSize(2048)
                            ->hint('Max size: 2MB. Formats: jpg, png, gif')
                            ->columnSpan('full'),
                    ])
                    ->columns(1) // 1 full-width column
                    ->collapsible(),

                Forms\Components\Section::make('Associations')
                    ->schema([
                        Select::make('user_id')
                            ->label('Creator')
                            ->relationship('user', 'name') // Assuming the user relationship
                            ->searchable()
                            ->required()
                            ->placeholder('Select creator'),

                        Toggle::make('status')
                            ->label('Status')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2)
                    ->collapsible(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('status')
                ->label(''),

                ImageColumn::make('image_url')
                    ->label('')
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->label('Title'),

                TextColumn::make('user.name')
                    ->label('Creator')
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('like')
                    ->label('Likes')
                    ->sortable()
                    ->color(fn ($record) => $record->like > 0 ? 'success' : 'danger'),

                BadgeColumn::make('comment')
                ->label('Comments')
                ->sortable()
                ->color(fn ($record) => $record->comment > 0 ? 'success' : 'danger'),

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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
