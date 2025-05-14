<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RawmaterialResource\Pages;
use App\Filament\Resources\RawmaterialResource\RelationManagers;
use App\Models\Rawmaterial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RawmaterialResource extends Resource
{
    protected static ?string $model = Rawmaterial::class;

    protected static ?string $navigationIcon = 'heroicon-s-cube-transparent';

    protected static ?string $navigationGroup = "STOCK";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('purchase_party')->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\TextInput::make('quantity')->numeric()->required(),
                Forms\Components\TextInput::make('total')->numeric()->disabled(), 
                Forms\Components\TextInput::make('stock'),
                Forms\Components\TextInput::make('stock_amount')->numeric()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category'), 
                Tables\Columns\TextColumn::make('name'), 
                Tables\Columns\TextColumn::make('purchase_party'), 
                Tables\Columns\TextColumn::make('price')
                ->formatStateUsing(fn ($record) => number_format($record->price) . ' ₹'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($record) => number_format($record->price * $record->quantity) . ' ₹')
                    ->getStateUsing(fn ($record) => $record->price * $record->quantity),
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
            'index' => Pages\ListRawmaterials::route('/'),
            'create' => Pages\CreateRawmaterial::route('/create'),
            'edit' => Pages\EditRawmaterial::route('/{record}/edit'),
        ];
    }
}
