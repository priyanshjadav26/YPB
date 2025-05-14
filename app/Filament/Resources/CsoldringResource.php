<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CsoldringResource\Pages;
use App\Filament\Resources\CsoldringResource\RelationManagers;
use App\Models\Csoldring;
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

class CsoldringResource extends Resource
{
    protected static ?string $model = Csoldring::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-pie';

    protected static ?string $navigationGroup = "MANUFACTURING";
    protected static ?string $pluralModelLabel = 'Soldring';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('worker_id')
                ->relationship('worker', 'name', function (Builder $query) {
                    $query->where('department', 'Soldering');
                })
                //->require(),
                // Forms\Components\DatePicker::make('name')
                //     ->required()
                //     ->default(Carbon::now()),
//class Acasting         
                ->required(),
                Forms\Components\DatePicker::make('givendate')
                    ->required()
                    ->default(Carbon::now()),
                Forms\Components\Textarea::make('details')
                    ->required(),
                Forms\Components\TextInput::make('casting_weight')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('lasiya_weight')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('givenweight')
                     ->numeric(),
                    Forms\Components\DatePicker::make('receivedate')
                    ->nullable(),
                    Forms\Components\DatePicker::make('receivedate')
                        ->nullable(),
                        Forms\Components\TextInput::make('receiveweight')
                        ->nullable()
                        ->numeric()
                        ->reactive()
                         
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $rate = $get('rate') ?? 0;
                            $givenweight = $get('casting_weight') + $get('lasiya_weight');
                            $set('givenweight', $givenweight);
                            $set('total', $state * $rate);
                            $set('difference', $givenweight - $state);
                            $set('totalweight', $totalweighr);
                        }),
                    Forms\Components\TextInput::make('piece') // Add pieces field
                        ->required()
                        ->numeric()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $rate = $get('rate') ?? 0;
                            $receiveweight = $get('receiveweight') ?? 0;
                            $givenweight = $get('casting_weight') + $get('lasiya_weight');
                            $set('givenweight', $givenweight);
                            $set('total', $state * $rate); // Update total based on pieces
                            $set('difference', $givenweight - $receiveweight);
                            
                        }),
                    Forms\Components\TextInput::make('rate')
                        ->nullable()
                        ->numeric()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $receiveweight = $get('receiveweight') ?? 0;
                            $piece = $get('piece') ?? 0; // Get pieces
                            $set('total', $state * $piece); // Update total based on rate and pieces
                        }),
                    Forms\Components\TextInput::make('total')
                        ->nullable()
                        ->numeric()
                        ->hiddenOn('create'),
                    Forms\Components\TextInput::make('difference')
                        ->nullable()
                        ->numeric()
                        ->disabled()
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
                Tables\Columns\TextColumn::make('details'),
                Tables\Columns\TextColumn::make('casting_weight')
                 ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('lasiya_weight')
                 ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('givenweight')
                 ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('receivedate')->sortable()->date()
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('Y-m-d'))
                ->label('Receive Date'),
                Tables\Columns\TextColumn::make('receiveweight')
                ->label('Receive Weight')
                ->formatStateUsing(fn($state) => $state . ' kg'),
                 Tables\Columns\TextColumn::make('difference')
                    ->label('Difference')
                    ->formatStateUsing(fn($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('piece')->label('Piece')->formatStateUsing(fn($state) => $state),
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
                            $data['updated_at'] ?? null,
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
            'index' => Pages\ListCsoldrings::route('/'),
            'create' => Pages\CreateCsoldring::route('/create'),
            'edit' => Pages\EditCsoldring::route('/{record}/edit'),
        ];
    }
}
