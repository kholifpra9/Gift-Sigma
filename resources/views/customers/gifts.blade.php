<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Gift History — {{ $customer->name }}</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6">
        @foreach($customer->giftOrders as $order)
            <div class="bg-white border rounded-lg p-4 mb-4 shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-lg">Order #{{ $order->id }}</h3>
                        <p class="text-sm text-slate-600">
                            Status:
                            @if($order->status == 1)
                                <span class="text-yellow-600">Pending</span>
                            @elseif($order->status == 5)
                                <span class="text-green-600">Delivered</span>
                            @endif
                        </p>
                        <p class="text-sm text-slate-500">
                            CS: {{ $order->customerService->name }}
                        </p>
                    </div>

                    <div class="text-sm text-slate-500">
                        {{ $order->created_at->format('d M Y') }}
                    </div>
                </div>

                <div class="mt-3 border-t pt-3">
                    @foreach($order->items as $item)
                        <div class="flex items-start gap-3 mb-3">
                            <div class="flex-1">
                                <p class="font-medium">{{ $item->catalog->name }}</p>
                                <p class="text-sm text-slate-600">
                                    Platform: {{ $item->catalog->platform ?? '-' }}
                                </p>
                                @if($item->catalog->link)
                                    <a href="{{ $item->catalog->link }}" target="_blank"
                                       class="text-sm text-sky-600 underline">
                                        Lihat Barang
                                    </a>
                                @endif
                            </div>

                            <div class="text-sm font-medium">
                                Qty: {{ $item->quantity }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($customer->giftOrders->count() === 0)
            <div class="text-center text-slate-500 py-12">
                Belum ada gift untuk customer ini.
            </div>
        @endif
    </div>
</x-app-layout>
