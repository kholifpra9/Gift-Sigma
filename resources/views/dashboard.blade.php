<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gift Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STATISTICS CARD --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total Orders --}}
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow border">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Total Gift Orders</p>
                    <h2 class="text-3xl font-bold mt-1">{{ $totalOrders }}</h2>
                </div>

                {{-- Pending --}}
                <div class="p-6 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl shadow border border-yellow-200">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">Pending</p>
                    <h2 class="text-3xl font-bold text-yellow-800 dark:text-yellow-200 mt-1">{{ $pending }}</h2>
                </div>

                {{-- Delivered --}}
                <div class="p-6 bg-green-50 dark:bg-green-900/30 rounded-xl shadow border border-green-200">
                    <p class="text-sm text-green-700 dark:text-green-300">Delivered</p>
                    <h2 class="text-3xl font-bold text-green-800 dark:text-green-200 mt-1">{{ $delivered }}</h2>
                </div>

                {{-- Total Item Diberikan --}}
                <div class="p-6 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl shadow border border-indigo-200">
                    <p class="text-sm text-indigo-700 dark:text-indigo-300">Total Items Ordered</p>
                    <h2 class="text-3xl font-bold text-indigo-800 dark:text-indigo-200 mt-1">{{ $totalItems }}</h2>
                </div>

            </div>


            {{-- LATEST ORDERS --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border overflow-hidden">
                <div class="px-6 py-4 border-b dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Latest Gift Orders</h3>

                    <a href="{{ route('gift-orders.index') }}"
                        class="px-3 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Lihat Semua
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700/40">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Customer</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">CS</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($latestOrders as $order)
                            <tr>
                                <td class="px-4 py-3 text-sm">#{{ $order->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $order->customer->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $order->customerService->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($order->status == 5)
                                        <span class="text-green-600 font-medium">Delivered</span>
                                    @else
                                        <span class="text-yellow-600 font-medium">Pending</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('gift-orders.show', $order->id) }}"
                                        class="text-indigo-600 hover:underline text-sm">
                                        Detail →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada gift order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
