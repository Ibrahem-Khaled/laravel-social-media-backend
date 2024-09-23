<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrameUserResource\Pages;
use App\Filament\Resources\FrameUserResource\RelationManagers;
use App\Models\FrameUser;
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

class FrameUserResource extends Resource
{
    protected static ?string $model = FrameUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';


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

                BadgeableColumn::make('frame')
                    ->label('Frame')
                    ->getStateUsing(function ($record) {
                        return $record->frame->title;
                    })
                    ->sortable()
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('entry.price')
                            ->label(fn ($record) => ($record->frame->price . ' TUR' ?? 'N/A'))
                            ->color('success'),
                    ]),

                Tables\Columns\TextColumn::make('purchased_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('expires_at')
                    ->label('Expiration Date')
                    ->getStateUsing(fn ($record) =>
                        !$record->expires_at
                            ? 'No Expiration Date'
                            : ($record->expires_at < now()
                                ? 'Expired on ' . $record->expires_at->format('Y-m-d')
                                : 'Valid until ' . $record->expires_at->format('Y-m-d'))
                    )
                    ->color(fn ($record) =>
                        !$record->expires_at
                            ? 'info'
                            : ($record->expires_at < now() ? 'danger' : 'success')
                    )
            ])
            ->filters([
                SelectFilter::make('user')
                    ->label('User')
                    ->relationship('user', 'name'),

                SelectFilter::make('frame')
                    ->label('Frame')
                    ->relationship('frame', 'title'),

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
            'index' => Pages\ListFrameUsers::route('/'),
            'create' => Pages\CreateFrameUser::route('/create'),
            'edit' => Pages\EditFrameUser::route('/{record}/edit'),
        ];
    }
}
