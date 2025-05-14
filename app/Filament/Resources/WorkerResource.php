<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkerResource\Pages;
use App\Filament\Resources\WorkerResource\RelationManagers;
use App\Models\Worker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;

class WorkerResource extends Resource
{
    protected static ?string $model = Worker::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'), 
                Forms\Components\TextInput::make('contact')
                 ->required()
                    ->numeric()
                    ->minLength(10)
                    ->maxLength(10)
                    ->rules(['regex:/^\d{10}$/']),
                                         
                    Select::make('department')
                        ->options
                        ([
                            'Packaging' => 'packaging',
                            'Casting' => 'casting',
                            'Soldering' => 'soldering',
                            'Mina / Dimond' => 'mina/dimond',
                            'Vibrating' => 'vibrating',
                            'Lasiya' => 'lasiya',
                            'Bidding' => 'bidding',
                            'Jabora' => 'jabora',
                            'Fitting' => 'fitting',
                            'Nickel' => 'nickel',
                          
                            
                        ])
                        ->native(false),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'), 
                Tables\Columns\TextColumn::make('contact'),
                Tables\Columns\TextColumn::make('department'),
  
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
            'index' => Pages\ListWorkers::route('/'),
            'create' => Pages\CreateWorker::route('/create'),
            'edit' => Pages\EditWorker::route('/{record}/edit'),
        ];
    }
}
