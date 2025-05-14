<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HpackagingResource\Pages;
use App\Filament\Resources\HpackagingResource\RelationManagers;
use App\Models\Hpackaging;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Summarizers;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Forms\Components\DatePicker;


use Carbon\Carbon;

class HpackagingResource extends Resource
{
    protected static ?string $model = Hpackaging::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-pie';
    protected static ?string $navigationGroup = "MANUFACTURING";
    protected static ?string $pluralModelLabel = 'Packaging';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('worker_id')
                ->relationship('worker', 'name', function (Builder $query) {
                    $query->where('department', 'Packaging');
                })
                ->required(),
                Forms\Components\DatePicker::make('givendate')
                    ->required()
                    ->default(Carbon::now()),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('details')
                    ->required(),
                Forms\Components\DatePicker::make('receivedate')
                    ->nullable()
                    ->displayFormat('Y-m-d'),
                    Forms\Components\TextInput::make('receiveweight')
                    ->nullable()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $weight = $get('weight') ?? 0;
                        $rate = $get('rate') ?? 0;
                        $set('total', $state * $rate);
                        $set('difference', $weight - $state);
                    }),
                 Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->reactive(),
                Forms\Components\TextInput::make('rate')
                    ->nullable()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $receiveweight = $get('receiveweight') ?? 0;
                        $set('total', $state * $receiveweight);
                    }),
                Forms\Components\TextInput::make('total')
                    ->nullable()
                    ->numeric()
                    // ->disabled(),
                    ->hiddenOn('create'),
                    Forms\Components\TextInput::make('difference')
                    ->nullable()
                    ->numeric()
                    // ->disabled()
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('worker.name')->label('Worker Name')->searchable(),
                Tables\Columns\TextColumn::make('givendate')
                ->label('Given Date'),
                Tables\Columns\TextColumn::make('weight')
                 ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('details'),

                Tables\Columns\TextColumn::make('receivedate')
                    ->label('Receive Date')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('Y-m-d')), 
                    

                Tables\Columns\TextColumn::make('receiveweight')
                ->label('Receive Weight')
                ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('difference')->label('Difference')->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('rate')
                    ->label('rate/kg')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹'),
                    Tables\Columns\TextColumn::make('total')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                    ->summarize(Summarizers\Sum::make()
                    ->label('Grand Total')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                ),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHpackagings::route('/'),
            'create' => Pages\CreateHpackaging::route('/create'),
            'edit' => Pages\EditHpackaging::route('/{record}/edit'),
        ];
    }
}
