<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Resources\BankAccountResource\RelationManagers;
use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $modelLabel = 'Bank Account';
    protected static ?string $navigationLabel = 'Bank Accounts';
    protected static ?string $navigationGroup = 'Payment Settings';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Bank Information')
                    ->schema([
                        TextInput::make('bank_name')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),
                            
                        TextInput::make('account_number')
                            ->required()
                            ->numeric()
                            ->unique(ignoreRecord: true)
                            ->maxLength(30),
                            
                        TextInput::make('account_name')
                            ->required()
                            ->maxLength(100),
                            
                        Toggle::make('is_active')
                            ->default(true)
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Textarea::make('notes')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bank_name')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('account_number')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('account_name')
                    ->searchable()
                    ->sortable(),
                    
                IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->action(
                        Tables\Actions\Action::make('toggleStatus')
                            ->icon('heroicon-o-arrow-path')
                            ->action(function (BankAccount $record) {
                                $record->is_active = !$record->is_active;
                                $record->save();
                            })
                    ),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->label('Status'),
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
                    Tables\Actions\BulkAction::make('activate')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->icon('heroicon-o-check-circle')
                        ->color('success'),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->icon('heroicon-o-x-circle')
                        ->color('danger'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('bank_name', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccount::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}