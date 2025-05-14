<x-tables::row>
    <x-tables::cell>
        {{-- for the checkbox column --}}
    </x-tables::cell>
    @foreach ($columns as $column)
        <x-tables::cell
            wire:loading.remove.delay
            wire:target="{{ implode(',', \Filament\Tables\Table::LOADING_TARGETS) }}"
        >
            @if ($column->getName() == 'total')
                <div class="filament-tables-column-wrapper">
                    <div class="filament-tables-text-column px-4 py-2 flex w-full justify-start text-start">
                        <div class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                            <span class="font-medium">
                            Grand Total: {{ $grandTotal }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </x-tables::cell>
    @endforeach
</x-tables::row>