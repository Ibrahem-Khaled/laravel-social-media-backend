<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryUserResource\Pages;
use App\Filament\Resources\EntryUserResource\RelationManagers;
use App\Models\EntryUser;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntryUserResource extends Resource
{
    protected static ?string $model = EntryUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $activeNavigationIcon = 'heroicon-s-heart';

    protected static ?string $navigationGroup = 'Gifting System';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 1 ? 'success' : 'warning';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        return $record->user->name;
                    }),
                    
                BadgeableColumn::make('entry')
                    ->label('Entry')
                    ->getStateUsing(function ($record) {
                        return $record->entry->title;
                    })
                    ->sortable()
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('entry.price')
                            ->label(fn ($record) => ($record->entry->price . ' TUR' ?? 'N/A'))
                            ->color('success'),
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->label('User')
                    ->relationship('user', 'name'),

                SelectFilter::make('entry')
                    ->label('Entry')
                    ->relationship('entry', 'title'),

                Filter::make('created_at')
                    ->label('Sent At')
                    ->form([
                        Forms\Components\DatePicker::make('created_at_from')->label('From'),
                        Forms\Components\DatePicker::make('created_at_until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_at_from'], fn($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_at_until'], fn($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
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
            'index' => Pages\ListEntryUsers::route('/'),
            'create' => Pages\CreateEntryUser::route('/create'),
            'edit' => Pages\EditEntryUser::route('/{record}/edit'),
        ];
    }
}
