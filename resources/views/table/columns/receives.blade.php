@php
    $receives = $getState();
@endphp

<div x-data="{ expanded: false }">
    <button @click="expanded = !expanded" class="text-blue-500 underline">Toggle Receives</button>
    <div x-show="expanded" class="mt-2">
        @if($receives->isNotEmpty())
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 text-gray-600 uppercase tracking-wider">Receive Date</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 text-gray-600 uppercase tracking-wider">Receive Weight</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 text-gray-600 uppercase tracking-wider">Rate</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 text-gray-600 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receives as $receive)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $receive->receive_date }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $receive->receive_weight }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $receive->rate }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $receive->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No receives data available.</p>
        @endif
    </div>
</div>
