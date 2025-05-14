<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnickelResource\Pages;
use App\Filament\Resources\EnickelResource\RelationManagers;
use App\Models\Enickel;
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


class EnickelResource extends Resource
{
    protected static ?string $model = Enickel::class;

    protected static ?string $navigationIcon = 'heroicon-s-chart-pie';
    protected static ?string $navigationGroup = "MANUFACTURING";
    protected static ?string $pluralModelLabel = 'Nickel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('worker_id')
                ->relationship('worker', 'name', function (Builder $query) {
                    $query->where('department', 'Nickel');
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


                    Forms\Components\Repeater::make('receives')
                    ->label('Receives')
                    ->schema([
                        Forms\Components\DatePicker::make('receive_date'),
                        Forms\Components\TextInput::make('receive_weight')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set, $get) => $set('total', $state * ($get('rate') ?? 0))),
                        Forms\Components\TextInput::make('rate')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $weight = $get('receive_weight') ?? 0;
                                $set('total', $weight * $state);
                            }),
                        Forms\Components\TextInput::make('total')
                            ->reactive()
                            ->nullable()
                            ->numeric()
                            ->disabled(),
                    ]),


            ]);
    }
    
    public static function create(Request $request)
    {
        $data = $request->all();
    
        // Create a new Acasting instance
        $acasting = new Enickel();
        $acasting->worker_id = $data['worker_id'];
        $acasting->givendate = $data['givendate'];
        $acasting->weight = $data['weight'];
        $acasting->details = $data['details'];
        $acasting->difference = $data['difference'];
    
        // Calculate the total receive weight and total
        $totalReceiveWeight = 0;
        $total = 0;
        if (isset($data['receives']) && is_array($data['receives'])) {
            foreach ($data['receives'] as $receive) {
                $totalReceiveWeight += $receive['receive_weight'];
                $total += $receive['total'];
            }
        }
        $acasting->total_receive_weight = $totalReceiveWeight;
        $acasting->total = $total;
    
        $acasting->save();
    
        // Store receives data in acasting_receives table
        if (isset($data['receives']) && is_array($data['receives'])) {
            foreach ($data['receives'] as $receive) {
                $receiveModel = new EnickelReceive();
                $receiveModel->enickel_id = $acasting->id;
                $receiveModel->receive_date = $receive['receive_date'];
                $receiveModel->receive_weight = $receive['receive_weight'];
                $receiveModel->rate = $receive['rate'];
                $receiveModel->total = $receive['total'];
                $receiveModel->save();
            }
        }
            
        // Redirect to the index page
        // return redirect()->route('filament.resources.acastings.index');
    }
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('worker.name')->label('Worker Name')->searchable(),
            Tables\Columns\TextColumn::make('givendate')->label('Given Date'),
            Tables\Columns\TextColumn::make('weight')->formatStateUsing(fn($state) => $state . ' kg'),
            Tables\Columns\TextColumn::make('details'),

                Tables\Columns\TextColumn::make('receive_dates')
                    ->label('Receive Dates')
                    ->getStateUsing(function ($record) {
                        return $record->receives->pluck('receive_date')->map(function ($date) {
                            return Carbon::parse($date)->format('Y-m-d');
                        })->implode('<br>');
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('receive_weight')
                    ->label('Receive Weights')
                    ->getStateUsing(function ($record) {
                        return $record->receives->pluck('receive_weight')->map(function ($weight) {
                            return $weight . ' kg';
                        })->implode('<br>');
                    })
                    ->html(),
                    
                    
                Tables\Columns\TextColumn::make('weight_difference')
                ->label('Difference')
                ->default('0.00 kg')
                ->getStateUsing(fn($record) => $record->weight_difference . ' kg'),

                Tables\Columns\TextColumn::make('rates')
                    ->label('Rates')
                    ->getStateUsing(function ($record) {
                        return $record->receives->pluck('rate')->map(function ($rate) {
                            return $rate . '₹';
                        })->implode('<br>');
                    })
                    ->html(),
                    
                    Tables\Columns\TextColumn::make('totals')
                    ->label('Totals')
                    ->getStateUsing(function ($record) {
                        return $record->receives->sum('total') . '₹';
                    })
                    ->html()
                    ->summarize(new class extends Summarizer {
                        public function summarize(\Illuminate\Database\Query\Builder $query, string $attribute): float
                        {
                            return Enickel::query()
                                ->with('receives')
                                ->whereIn('id', $query->pluck('id'))
                                ->get()
                                ->sum(function ($acasting) {
                                    return $acasting->receives->sum('total');
                                });
                        }
                    }),
                // ...
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
            'index' => Pages\ListEnickels::route('/'),
            'create' => Pages\CreateEnickel::route('/create'),
            'edit' => Pages\EditEnickel::route('/{record}/edit'),
        ];
    }
}
