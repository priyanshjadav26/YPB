<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => 
                        $set('total', $state * $get('quantity'))
                    ),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => 
                        $set('total', $state * $get('price'))
                    ),
                Forms\Components\Radio::make('quantity_type')
                    ->options([
                        'single' => 'Single',
                        'pair' => 'Pair',
                    ]),
                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->disabled(),
                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $get, callable $set) => 
                        $set('stock_amount', $get('total') * $state)
                    ),
                Forms\Components\TextInput::make('stock_amount')
                    ->numeric()
                    ->disabled(),
                    Forms\Components\TextInput::make('gst_rate')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $get, callable $set) => 
                    $set('gst_amount', $get('total') * $state / 100),
                    
                    
                ),
            Forms\Components\TextInput::make('gst_amount')
                ->numeric()
                ->disabled(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')
                ->formatStateUsing(fn ($record) => number_format($record->price). '₹'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('quantity_type'),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($record) => number_format($record->price * $record->quantity). '₹')
                    ->getStateUsing(fn ($record) => $record->price * $record->quantity),
                Tables\Columns\TextColumn::make('gst_rate')
                ->formatStateUsing(fn ($record) => number_format($record->gst_rate). '%'),
                Tables\Columns\TextColumn::make('created_at')
                        ->label('date')
                        ->date('Y-m-d'),

            

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
