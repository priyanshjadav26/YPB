<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('category')
                //  ->createOptionForm([
                // Forms\Components\TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //          ])
                //         ->options([
                //            'Packaging' => 'packaging',
                //             'Casting' => 'casting',
                //             'Soldering' => 'soldering',
                //             'Mina / Dimond' => 'mina/dimond',
                //             'Vibrating' => 'vibrating',
                //             'Lasiya' => 'lasiya',
                //             'Bidding' => 'bidding',
                //             'Nickel' => 'nickel',
                //         ])
                //         ->required()
                //         ->native(false),
                Forms\Components\Select::make('category')
    ->options([
        'Packaging' => 'packaging',
        'Casting' => 'casting',
        'Soldering' => 'soldering',
        'Mina / Dimond' => 'mina/dimond',
        'Vibrating' => 'vibrating',
        'Lasiya' => 'lasiya',
        'Bidding' => 'bidding',
        'Jabora' => 'jabora',
        'Fitting' => 'fitting',
    ])
    ->required()
    ->native(false),

// Forms\Components\TextInput::make('new_option')
//     ->label('Add new option')
//     ->afterStateUpdated(function ($state, $component) {
//         // Add the new option to the dropdown using JavaScript
//         $component->getSelectComponent()->options->push([
//             'label' => $state,
//             'value' => $state,
//         ]);
//     }),
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('purchase_party'),
                Forms\Components\TextInput::make('quantity'),
                Forms\Components\TextInput::make('price'),
                Forms\Components\TextInput::make('total')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('purchase_party'), 
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price')
                ->formatStateUsing(fn ($record) => number_format($record->price) . ' ₹'),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
