<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Detail Gift Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto space-y-6">

            <div class="bg-white shadow rounded-lg border p-5">
                <h3 class="font-semibold text-lg mb-3">Informasi Order</h3>

                <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
                <p><strong>Customer Service:</strong> {{ $order->customerService->name }}</p>
                <p><strong>Status:</strong>
                    <span class="px-2 py-1 text-xs rounded font-medium
                        @if($order->status == 1) bg-yellow-100 text-yellow-700
                        @elseif($order->status == 5) bg-green-100 text-green-700
                        @endif">
                        {{ $order->status == 5 ? 'Delivered' : 'Pending' }}
                    </span>
                </p>
            </div>

            <div class="bg-white shadow rounded-lg border p-5">
                <h3 class="font-semibold text-lg mb-3">Item Gift</h3>

                <ul class="space-y-2">
                    @foreach ($order->items as $item)
                        <li class="border rounded p-3">
                            <p class="font-medium">{{ $item->catalog->name }}</p>
                            <p class="text-sm text-gray-600">
                                Platform: {{ $item->catalog->platform ?? '-' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Link: 
                                @if ($item->catalog->link)
                                    <a href="{{ $item->catalog->link }}" class="text-blue-600" target="_blank">Open</a>
                                @else
                                    -
                                @endif
                            </p>
                            <p class="font-medium">Qty: {{ $item->quantity }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
