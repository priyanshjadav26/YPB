<?php
namespace App\Filament\Resources;

use App\Models\Salary;
use App\Models\Worker;
use App\Models\Hpackaging;
use App\Models\Gvibrating;
use App\Models\Blasiya;
use App\Models\Csoldring;
use App\Models\Dbidding;
use App\Models\Jabora;
use App\Models\Ifitting;
use App\Models\Enickel;
use App\Models\FdiamondMeena;
use App\Models\Acasting;
use App\Models\AcastingReceive;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\SalaryResource\Pages;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers;
use Filament\Tables\Columns\Summarizers\Summarizer;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
                return $form->schema([
                        
            Forms\Components\Select::make('worker_id')
                ->label('Worker Name')
                ->options(Worker::all()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $worker = Worker::find($state);
                    $set('department', $worker?->department);

                    if ($worker) {
                        switch ($worker->department) {
                            case 'Packaging':
                                $packagingData = Hpackaging::where('worker_id', $state)->get();
                                if ($packagingData->isNotEmpty()) {
                                    $set('given_salary', $packagingData->sum('given_salary'));
                                    $set('givendate', $packagingData->first()->givendate);
                                    $set('total', $packagingData->sum('total'));
                                }
                                break;

                            // case 'Casting':
                            //     $castingData = Acasting::where('worker_id', $state)->get();
                            //     if ($castingData->isNotEmpty()) {
                            //         $set('given_salary', $castingData->sum('given_salary'));
                            //         $set('givendate', $castingData->first()->givendate);
                            //         $set('total', $castingData->sum('total'));
                            //     }
                            //     break;

                            case 'Casting':
                                $castingData = Acasting::where('worker_id', $state)->get();
                                if ($castingData->isNotEmpty()) {
                                    $acastingIds = $castingData->pluck('id');
                                    $acastingReceiveData = AcastingReceive::whereIn('acasting_id', $acastingIds)->get();
                                    if ($acastingReceiveData->isNotEmpty()) {
                                        $set('given_salary', $acastingReceiveData->sum('given_salary'));
                                        $set('givendate', $acastingReceiveData->first()->givendate);
                                        $set('total', $acastingReceiveData->sum('total'));
                                    }
                                }
                                break;

                            case 'Soldering':
                                $solderingData = Csoldring::where('worker_id', $state)->get();
                                if ($solderingData->isNotEmpty()) {
                                    $set('given_salary', $solderingData->sum('given_salary'));
                                    $set('givendate', $solderingData->first()->givendate);
                                    $set('total', $solderingData->sum('total'));
                                }
                                break;

                            case 'Mina / Dimond':
                                $minaDimondData = FdiamondMeena::where('worker_id', $state)->get();
                                if ($minaDimondData->isNotEmpty()) {
                                    $set('given_salary', $minaDimondData->sum('given_salary'));
                                    $set('givendate', $minaDimondData->first()->givendate);
                                    $set('total', $minaDimondData->sum('total'));
                                }
                                break;

                            case 'Vibrating':
                                $vibratingData = Gvibrating::where('worker_id', $state)->get();
                                if ($vibratingData->isNotEmpty()) {
                                    $set('given_salary', $vibratingData->sum('given_salary'));
                                    $set('givendate', $vibratingData->first()->givendate);
                                    $set('total', $vibratingData->sum('total'));
                                }
                                break;

                            case 'Lasiya':
                                $lasiyaData = Blasiya::where('worker_id', $state)->get();
                                if ($lasiyaData->isNotEmpty()) {
                                    $set('given_salary', $lasiyaData->sum('given_salary'));
                                    $set('givendate', $lasiyaData->first()->givendate);
                                    $set('total', $lasiyaData->sum('total'));
                                }
                                break;

                            case 'Bidding':
                                $biddingData = Dbidding::where('worker_id', $state)->get();
                                if ($biddingData->isNotEmpty()) {
                                    $set('given_salary', $biddingData->sum('given_salary'));
                                    $set('givendate', $biddingData->first()->givendate);
                                    $set('total', $biddingData->sum('total'));
                                }
                                break;

                            case 'Nickel':
                                $nickelData = Enickel::where('worker_id', $state)->get();
                                if ($nickelData->isNotEmpty()) {
                                    $set('given_salary', $nickelData->sum('given_salary'));
                                    $set('givendate', $nickelData->first()->givendate);
                                    $set('total', $nickelData->sum('total'));
                                }
                                break;


                            case 'Jabora':
                                $jaboraData = Jabora::where('worker_id', $state)->get();
                                if ($jaboraData->isNotEmpty()) {
                                    $set('given_salary', $jaboraData->sum('given_salary'));
                                    $set('givendate', $jaboraData->first()->givendate);
                                    $set('total', $jaboraData->sum('total'));
                                }
                                break;

                            case 'Fitting':
                                $fittingData = Ifitting::where('worker_id', $state)->get();
                                if ($fittingData->isNotEmpty()) {
                                    $set('given_salary', $fittingData->sum('given_salary'));
                                    $set('givendate', $fittingData->first()->givendate);
                                    $set('total', $fittingData->sum('total'));
                                }
                                break;
    
                        }
                    }
            }),
            
            Forms\Components\TextInput::make('department')
            ->label('Department')
            ->required(),

          

             Forms\Components\DatePicker::make('from_date')
                    ->label('From Date')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $toDate = $get('to_date');
                        $workerId = $get('worker_id');
                        $department = $get('department');

                        if ($workerId && $toDate && $department) {
                            switch ($department) {
                                case 'Packaging':
                                    $total = Hpackaging::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                // case 'Casting':
                                //     $total = Acasting::where('worker_id', $workerId)
                                //         ->whereBetween('receivedate', [$state, $toDate])
                                //         ->sum('total');
                                //     break;

                                case 'Casting':
                                    $acastingIds = Acasting::where('worker_id', $workerId)->pluck('id');
                                    $total = AcastingReceive::whereIn('acasting_id', $acastingIds)
                                        ->whereBetween('receive_date', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Soldering':
                                    $total = Csoldring::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Mina / Dimond':
                                    $total = FdiamondMeena::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Vibrating':
                                    $total = Gvibrating::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Lasiya':
                                    $total = Blasiya::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Bidding':
                                    $total = Dbidding::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                case 'Nickel':
                                    $total = Enickel::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$state, $toDate])
                                        ->sum('total');
                                    break;

                                    case 'Fitting':
                                        $total = Ifitting::where('worker_id', $workerId)
                                            ->whereBetween('receivedate', [$fromDate, $state])
                                            ->sum('total');
                                        break;

                                        case 'Jabora':
                                            $total = jabora::where('worker_id', $workerId)
                                                ->whereBetween('receivedate', [$fromDate, $state])
                                                ->sum('total');
                                            break;

                                default:
                                    $total = 0; // Handle unknown departments or provide an error message
                                    break;
                            }

                            if ($total == 0) {
                                $set('total', 0);
                                $set('error', 'Data not found');
                            } else {
                                $set('total', $total);
                                $set('error', null);
                            }
                        }
                    }),

         Forms\Components\DatePicker::make('to_date')
                    ->label('To Date')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $fromDate = $get('from_date');
                    $workerId = $get('worker_id');
                    $department = $get('department');

                    if ($fromDate && $workerId && $department) {
                        switch ($department) {
                            case 'Packaging':
                                $total = Hpackaging::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            // case 'Casting':
                            //     $total = Acasting::where('worker_id', $workerId)
                            //         ->whereBetween('receivedate', [$fromDate, $state])
                            //         ->sum('total');
                            //     break;
                            case 'Casting':
                                $acastingIds = Acasting::where('worker_id', $workerId)->pluck('id');
                                $total = AcastingReceive::whereIn('acasting_id', $acastingIds)
                                    ->whereBetween('receive_date', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Soldering':
                                $total = Csoldring::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Mina / Dimond':
                                $total = FdiamondMeena::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Vibrating':
                                $total = Gvibrating::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Lasiya':
                                $total = Blasiya::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Bidding':
                                $total = Dbidding::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                            case 'Nickel':
                                $total = Enickel::where('worker_id', $workerId)
                                    ->whereBetween('receivedate', [$fromDate, $state])
                                    ->sum('total');
                                break;

                                case 'Fitting':
                                    $total = Ifitting::where('worker_id', $workerId)
                                        ->whereBetween('receivedate', [$fromDate, $state])
                                        ->sum('total');
                                    break;

                                    case 'Jabora':
                                        $total = jabora::where('worker_id', $workerId)
                                            ->whereBetween('receivedate', [$fromDate, $state])
                                            ->sum('total');
                                        break;

                                        

                            default:
                                $total = 0; // Handle unknown departments or provide an error message
                                break;
                        }

                        if ($total == 0) {
                            $set('total', 0);
                            $set('error', 'Data not found');
                        } else {
                            $set('total', $total);
                            $set('error', null);
                        }
                    }
            }),

    
            Forms\Components\DatePicker::make('givendate')
                ->label('Given Date')
                ->required(),

                Forms\Components\TextInput::make('given_salary')
                ->label('Given Salary')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $total = $get('total');
                    $set('difference', $total - $state);
                }),

             Forms\Components\TextInput::make('difference')
                ->label('Difference')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $total = $get('total');
                    $set('difference', $total - $state);
                }),
           
            Forms\Components\TextInput::make('total')
                ->label('Total')
                ->numeric()
                ->required()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $givenSalary = $get('given_salary');
                    $set('difference', $state - $givenSalary);
                    $fromDate = $get('from_date');
                    $toDate = $get('to_date');
                    $workerId = $get('worker_id');
                    $department = $get('department');

                    if ($fromDate && $toDate && $workerId && $department === 'Packaging') {
                                $total = Hpackaging::where('worker_id', $workerId)
                                    ->where('receivedate', '>=', $fromDate)
                                    ->where('receivedate', '<=', $toDate)
                                    ->sum('total');

                                $set('total', $total ?? 0);
                            } else {
                                $set('total', 0); // Reset total if any required fields are not selected
                            }
                        }),
                ]);
            }

            public static function table(Table $table): Table
            {
                return $table
                    ->columns([
                        Tables\Columns\TextColumn::make('worker.name')
                            ->label('Worker Name')
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('department')
                            ->label('Department')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('from_date')
                            ->label('From Date')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('to_date')
                            ->label('To Date')
                            ->sortable(),


                        // Tables\Columns\TextColumn::make('total')
                        //     ->label('Total')
                        //     ->formatStateUsing(fn ($record) => number_format($record->total) . ' ₹')
                        //     ->sortable(),

                        Tables\Columns\TextColumn::make('total')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                        ->summarize(Summarizers\Sum::make()
                        ->label('Grand Total')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                    ),
                



                        Tables\Columns\TextColumn::make('givendate')
                            ->label('Given Date')
                            ->sortable(),
                            
                        // Tables\Columns\TextColumn::make('given_salary')
                        //     ->label('Given Salary')
                        //     ->formatStateUsing(fn ($record) => number_format($record->given_salary) . ' ₹')
                        //     ->sortable(),

                        Tables\Columns\TextColumn::make('given_salary')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                        ->summarize(Summarizers\Sum::make()
                        ->label('Grand Total')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                    ),


                        Tables\Columns\TextColumn::make('difference')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                        ->summarize(Summarizers\Sum::make()
                        ->label('Grand Total')
                        ->formatStateUsing(fn($state) => number_format($state, 2) . ' ₹')
                    ),
                    ])
                    ->defaultSort('created_at', 'desc')
                    
                    // Tables\Columns\TextColumn::make('difference')
                    //     ->formatStateUsing(fn($state) => number_format($state, 2). '')
                    //     ->summarize(Summarizers\Sum::make())
                    //     ->label('Grand Total')
                    //     ->formatStateUsing(fn($state) => number_format($state, 2). '')
                    // ])
                    // ->defaultSort('created_at', 'desc')
                    



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
                    'index' => Pages\ListSalaries::route('/'),
                    'create' => Pages\CreateSalary::route('/create'),
                    'edit' => Pages\EditSalary::route('/{record}/edit'),
                ];
            }
}