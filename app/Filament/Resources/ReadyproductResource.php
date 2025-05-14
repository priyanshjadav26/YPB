<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReadyproductResource\Pages;
use App\Filament\Resources\ReadyproductResource\RelationManagers;
use App\Models\Readyproduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReadyproductResource extends Resource
{
    protected static ?string $model = Readyproduct::class;

    protected static ?string $navigationIcon = 'heroicon-s-cube';

    protected static ?string $navigationGroup = "STOCK";

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('product_id')->required()->hidden(),
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('price')->numeric()->required(),
            Forms\Components\TextInput::make('quantity')->numeric()->required(),
            Forms\Components\TextInput::make('quantity_type')->required(),
            Forms\Components\TextInput::make('total')->numeric()->disabled(),
            Forms\Components\TextInput::make('stock')->required(),
            Forms\Components\TextInput::make('stock_amount')->numeric()->disabled(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('price')->label('Price')
                ->formatStateUsing(fn ($record) => number_format($record->price) . ' ₹'),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity'),
                Tables\Columns\TextColumn::make('quantity_type')->label('Quantity Type'),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($record) => number_format($record->price * $record->quantity) . ' ₹')
                    ->getStateUsing(fn ($record) => $record->price * $record->quantity),
                    Tables\Columns\TextColumn::make('stock')->label('Stock'),
                    Tables\Columns\TextColumn::make('stock_amount')
                    ->formatStateUsing(function ($record) {
                        return number_format($record->total * $record->stock) . ' ₹';
                    })
                    // Tables\Columns\TextColumn::make('gst_rate')->label('Gst Rate'),
                    // Tables\Columns\TextColumn::make('gst_amount') ->label('Gst Amount')
                ->getStateUsing(function ($record) {
                    return $record->total * $record->stock;
                }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
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
            'index' => Pages\ListReadyproducts::route('/'),
            'create' => Pages\CreateReadyproduct::route('/create'),
            'edit' => Pages\EditReadyproduct::route('/{record}/edit'),
        ];
    }
}
