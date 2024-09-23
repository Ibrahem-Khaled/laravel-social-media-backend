<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftUserResource\Pages;
use App\Filament\Resources\GiftUserResource\RelationManagers;
use App\Models\GiftUser;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\DateFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GiftUserResource extends Resource
{
    protected static ?string $model = GiftUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

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
                Tables\Columns\TextColumn::make('from_user')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        return $record->fromUser->name;
                    }),
                Tables\Columns\TextColumn::make('to_user')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        return $record->toUser->name;
                    }),

                BadgeableColumn::make('gift')
                    ->label('Gift')
                    ->getStateUsing(function ($record) {
                        return $record->gift->title;
                    })
                    ->sortable()
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('gift.price') // Correctly referring to the gift's price
                            ->label(fn ($record) => ($record->gift->price . ' TUR' ?? 'N/A')) // Display price or 'N/A' if null
                            ->color('success'),
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Sent At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('from_user')
                    ->label('From User')
                    ->relationship('fromUser', 'name'),

                SelectFilter::make('to_user')
                    ->label('To User')
                    ->relationship('toUser', 'name'),

                SelectFilter::make('gift')
                    ->label('Gift')
                    ->relationship('gift', 'title'),

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
            'index' => Pages\ListGiftUsers::route('/'),
            'create' => Pages\CreateGiftUser::route('/create'),
            'edit' => Pages\EditGiftUser::route('/{record}/edit'),
        ];
    }
}
