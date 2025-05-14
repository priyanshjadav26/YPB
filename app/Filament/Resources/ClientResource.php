<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Name'),
                Forms\Components\TextInput::make('address')
                    ->label('Address'),
                Forms\Components\TextInput::make('contact')
                    ->label('Contact')
                    ->rules(['required', 'numeric', 'digits:10']),
                Forms\Components\TextInput::make('city')
                    ->label('City'),
                Forms\Components\TextInput::make('gst_in')
                    ->label('GSTIN')
                    ->label('GSTIN')
                    ->rules(['required', 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'])
                    ->helperText('GSTIN should be a 15-character alphanumeric string.')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Name'),
                Tables\Columns\TextColumn::make('address')
                ->label('Address'),
                Tables\Columns\TextColumn::make('contact')
                ->label('Contact'),
                Tables\Columns\TextColumn::make('city')
                ->label('City'),
                Tables\Columns\TextColumn::make('gst_in')
                ->label('GSTIN'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
