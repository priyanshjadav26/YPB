<?php
namespace App\Filament\Resources;

use App\Models\Invoice;
use App\Models\Readyproduct;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ButtonAction;
use App\Filament\Resources\InvoiceResource\Pages;
use PDF;
use Illuminate\Support\Facades\Log;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('invoice_date')
                    ->required(),


                    Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $price = $get('price');
                                $set('total', $price * $state);
                            }),
                
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $quantity = $get('quantity');
                                $set('total', $state * $quantity);
                            }),
                
                        Forms\Components\TextInput::make('total')
                            ->numeric()
                            ->required(),
                    


                      
                
                        Forms\Components\TextInput::make('gst_rate')
                            ->numeric()
                            ->nullable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $set('gst_amount', ($get('total') * ($state ?? 0)) / 100);
                            }), 
 
                           Forms\Components\TextInput::make('gst_amount')
                            ->numeric()
                            ->disabled(),
                    ])
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('total_amount', collect($state)->sum(fn ($item) => $item['total'] + ($item['gst_amount'] ?? 0)));
                    }),
              
                    
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->required()
                    ->disabled(),
                            ]);
                }


                public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')->label('Client'),
                Tables\Columns\TextColumn::make('total_amount')->label('Total Amount'),
                Tables\Columns\TextColumn::make('invoice_date')->label('Invoice Date'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ButtonAction::make('downloadNormalBill')
                ->label('Download Normal Bill')
                ->action(function(Invoice $record){
                    session()->put('record',$record);
                    return redirect(route('invoice.normal'));
                })
                ->color('primary'),
            ButtonAction::make('downloadGstBill')
                ->label('Download GST Bill')
                ->action(function(Invoice $record){
                    session()->put('record',$record);
                    return redirect(route('invoice.gst'));
                })
                ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

                public static function getPages(): array
                {
                    return [
                        'index' => Pages\ListInvoices::route('/'),
                        'create' => Pages\CreateInvoice::route('/create'),
                        'edit' => Pages\EditInvoice::route('/{record}/edit'),
                    ];
                }

                public static function downloadNormalBill(Invoice $record)
                {
                    $data = [
                        'invoice' => $record,
                        'client' => $record->client,
                        'items' => $record->items,
                    ];

                    $pdf = PDF::loadView('invoices.normal_bill', $data);

                    return $pdf->download('normal_bill.pdf');
                }

                public static function downloadGstBill(Invoice $record)
                {
                    $data = [
                        'invoice' => $record,
                        'client' => $record->client,
                        'items' => $record->items,
                    ];

                    $pdf = PDF::loadView('invoices.gst_invoice', $data);

                    return $pdf->download('gst_bill.pdf');
                }
                
            }