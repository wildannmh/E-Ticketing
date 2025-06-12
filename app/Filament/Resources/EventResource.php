<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use App\Models\Organizer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('organizer_id')
                ->label('Organizer')
                ->options(Organizer::pluck('name', 'id')) // Ambil semua organizer
                ->searchable()
                ->required(),

                TextInput::make('organizer.user.name')
                ->label('Pengaju')
                ->disabled()
                ->default(Auth::user()?->name),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\TextInput::make('location')->required(),
                Forms\Components\TextInput::make('location_link')
                ->label('Location Link (Google Maps)')
                ->url()
                ->nullable(),
                Forms\Components\DateTimePicker::make('start_date')->required(),
                Forms\Components\DateTimePicker::make('end_date')->required(),
                Forms\Components\FileUpload::make('banner_image')
                    ->disk('public') 
                    ->directory('event-banners') 
                    ->image()
                    ->maxSize(2048)
                    ->nullable(),
                Forms\Components\Select::make('category')
                ->options([
                    'Festival'=> 'Festival',
                    'Konser' => 'Konser',
                    'Expo' => 'Expo',
                    'Volunteer'=>'Volunteer',
                ])
                ->required(),
                Forms\Components\Textarea::make('policies')->nullable(),
                Forms\Components\Toggle::make('is_published')->label('Publish?')
                ->default('Unpublished')
                ->disabled(fn () => auth()->user()->role !== 'admin')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('category')
            ->sortable(),
            TextColumn::make('organizer.user.name')
            ->label('Pengaju')
            ->searchable()
            ->sortable(),
            BadgeColumn::make('approval_status')
            ->label('Status')
            ->colors([
                'warning' => 'Unpublished',
                'success' => 'Published',
            ])
            ->sortable(),
            TextColumn::make('start_date')->label('Start')
            ->dateTime()
            ->sortable(),
            TextColumn::make('end_date')->label('End')
            ->dateTime()
            ->sortable(),
            TextColumn::make('created_at')
            ->label('Dibuat Pada')
            ->dateTime()
            ->sortable(),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}

