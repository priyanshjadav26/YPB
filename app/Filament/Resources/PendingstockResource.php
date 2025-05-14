<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingstockResource\Pages;
use App\Filament\Resources\PendingstockResource\RelationManagers;
use App\Models\Pendingstock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendingstockResource extends Resource
{
    protected static ?string $model = Pendingstock::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
      protected static ?string $navigationIcon = 'heroicon-s-clock'; 

    protected static ?string $navigationGroup = "STOCK";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required(),
            Forms\Components\TextInput::make('quantity')
                ->label('Quantity')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->sortable(),
            Tables\Columns\TextColumn::make('quantity')
                ->label('Quantity')
                ->sortable(),
        ])

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
            'index' => Pages\ListPendingstocks::route('/'),
            'create' => Pages\CreatePendingstock::route('/create'),
            'edit' => Pages\EditPendingstock::route('/{record}/edit'),
        ];
    }
}
