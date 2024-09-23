<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use Filament\Tables\Filters\Filter;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Filament\Actions\Exports\ExportColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('User Details')
                        ->description('The user personal details')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan('full'),

                            Forms\Components\TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->unique('users', 'email', ignoreRecord: true)
                                ->maxLength(255)
                                ->columnSpan('full'),

                            Forms\Components\TextInput::make('phone')
                                ->label('Phone Number')
                                ->tel()
                                ->required()
                                ->unique('users', 'phone', ignoreRecord: true)
                                ->columnSpan('full'),

                            Forms\Components\TextInput::make('address')
                                ->label('Address')
                                ->maxLength(500)
                                ->columnSpan('full'),
                        ])
                        ->columns(2),

                    Forms\Components\Wizard\Step::make('Role and Status')
                        ->description('The user role and security')
                        ->icon('heroicon-o-shield-check')
                        ->schema([
                            Forms\Components\Select::make('role')
                                ->label('Role')
                                ->options([
                                    'superAdmin' => 'Super Admin',
                                    'admin' => 'Admin',
                                    'editor' => 'Editor',
                                    'user' => 'User',
                                ])
                                ->required()
                                ->columnSpan('full'),

                            Forms\Components\Toggle::make('status')
                                ->label('Active Status')
                                ->inline(false)
                                ->columnSpan('full'),

                            Forms\Components\TextInput::make('password')
                                ->label('Password')
                                ->required()
                                ->columnSpan('full'),
                        ])
                        ->columns(2),
                ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                <x-filament::button
                    type="submit"
                    size="sm"
                >
                    Submit
                </x-filament::button>
            BLADE)))
                ->columnSpan('full')
                ->nextAction(
                    fn (Action $action) => $action->label('Next step'),
                ),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture_url')
                    ->label('')
                    ->circular(),

                ToggleColumn::make('status')
                    ->label('Status'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('role')
                    ->badge(function (User $user) {
                        return $user->role;
                    })
                    ->color(function (User $user) {
                        return match ($user->role) {
                            'editor' => 'primary',
                            'superAdmin' => 'success',
                            'admin' => 'info',
                            'user' => 'danger',
                        };
                    })
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('address')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('following')
                    ->badge()
                    ->color(function (User $user) {
                        return $user->following > 0 ? 'success' : 'danger';
                    })
                    ->sortable(),

                TextColumn::make('followers')
                    ->badge()
                    ->color(function (User $user) {
                        return $user->followers > 0 ? 'success' : 'danger';
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_activity_at')
                    ->label('Last Activity')
                    ->getStateUsing(fn($record) => $record->last_activity_at ? $record->last_activity_at->diffForHumans() . " ({$record->last_activity_ip})" : 'No activity yet')
                    ->badge()
                    ->color(fn($record) => $record->last_activity_at ? 'success' : 'danger')
                    ->sortable(),


                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),




                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                ->options([
                    'editor' => 'Editor',
                    'superAdmin' => 'Super Admin',
                    'admin' => 'Admin',
                    'user' => 'User',

                ]),

                Filter::make('Disabled')
                    ->query(fn (Builder $query) => $query->where('status', false)),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
