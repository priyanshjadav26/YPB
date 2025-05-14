<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlasiyaResource\Pages;
use App\Filament\Resources\BlasiyaResource\RelationManagers;
use App\Models\Blasiya;
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

class BlasiyaResource extends Resource
{
    protected static ?string $model = Blasiya::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-pie';
    protected static ?string $navigationGroup = "MANUFACTURING";
    protected static ?string $pluralModelLabel = 'Lasiya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('worker_id')
                ->relationship('worker', 'name', function (Builder $query) {
                    $query->where('department', 'Lasiya');
                })
                ->required(),
                Forms\Components\DatePicker::make('givendate')
                    ->required()
                    ->default(Carbon::now()),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                    Forms\Components\Select::make('type')
                    ->options([
                        'thin' => 'Thin',
                        'thick' => 'Thick',
                        'pital' => 'Pital',
                    ])
                    ->nullable(),
                Forms\Components\TextInput::make('rate')
                    ->nullable()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $weight = $get('weight') ?? 0;
                        $set('total', $state * $weight);
                    }),
                Forms\Components\TextInput::make('total')
                    ->nullable()
                    ->numeric()
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
                 Tables\Columns\TextColumn::make('type')->label('Type'),
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
            'index' => Pages\ListBlasiyas::route('/'),
            'create' => Pages\CreateBlasiya::route('/create'),
            'edit' => Pages\EditBlasiya::route('/{record}/edit'),
        ];
    }
}
