<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">
                Gift Orders
            </h2>

            {{-- Tombol Tambah --}}
            <a href="{{ route('gift-orders.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                + Tambah Gift Order
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="container mx-auto">
            <div class="bg-white shadow rounded-lg overflow-hidden border">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Customer</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Customer Service</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-4 py-3 text-right text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold">
                                    #{{ $order->id }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $order->customer->name }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $order->customerService->name }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        @if($order->status == 1) bg-yellow-100 text-yellow-700
                                        @elseif($order->status == 5) bg-green-100 text-green-700
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ $order->status == 5 ? 'Delivered' : 'Pending' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('gift-orders.show', $order->id) }}"
                                        class="text-blue-600 hover:underline text-sm">
                                        Lihat Detail →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-4 py-3 border-t">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
