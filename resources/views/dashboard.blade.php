<!-- resources/views/dashboard.blade.php -->

@extends('filament::page')

@section('content')
    <div class="flex justify-center mb-4">
        @livewire('chart-switcher')
    </div>
    <div class="w-full h-full">
        @livewire('filament.widgets.dynamic-chart')
    </div>

    <div class="center-section">
        <div class="text-1xl font-bold tracking-tighter flex items-center">
            YP Bichiya
        </div>
    </div>
@endsection
<style>
    .full-page-chart {
        width: 100%;
        height: calc(100vh - 100px); /* Adjust height as needed */
    }
</style>
