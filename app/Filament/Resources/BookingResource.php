<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order_number')
                    ->label('Number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('event.category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('event.title')
                    ->label('Event')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\TextColumn::make('payment.status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'gray' => fn ($state) => $state === 'pending',
                        'success' => fn ($state) => $state === 'verified',
                        'danger' => fn ($state) => $state === 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User') // Jika ingin tampilkan nama pemesan
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('payment.status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('approvePayment')
                    ->label('Approve Payment')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->payment?->status === 'pending')
                    ->action(function ($record) {
                        $record->payment->update(['status' => 'verified']);
                        $record->update(['status' => 'confirmed']);

                        Notification::make()
                            ->title('Payment verified and booking confirmed')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('rejectPayment')
                    ->label('Reject Payment')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => $record->payment?->status === 'pending')
                    ->action(function ($record) {
                        $record->payment->update(['status' => 'rejected']);
                        $record->update(['status' => 'cancelled']);

                        Notification::make()
                            ->title('Payment rejected and booking cancelled')
                            ->danger()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
        ];
    }
}
