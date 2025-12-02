{{-- resources/views/gift_orders/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Buat Gift Order</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            {{-- Flash / Success --}}
            @if(session('success'))
                <div class="mb-4 p-3 rounded text-sm bg-green-50 border border-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded bg-red-50 border border-red-100 text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gift-orders.store') }}" method="POST" x-data="giftOrderForm()">
                @csrf

                {{-- CUSTOMER --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Pilih Customer</label>
                        <select name="customer_id" required
                                class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-1 focus:ring-sky-500 focus:border-sky-500">
                            <option value="">-- Pilih Customer --</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}"
                                    {{ old('customer_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <input type="hidden"
                            value="{{ auth()->user()->name }}"
                            class="mt-1 block w-full rounded-md border-gray-200 bg-gray-50 px-3 py-2 shadow-sm"
                            disabled>

                        {{-- Hidden input untuk ID customer_service --}}
                        <input type="hidden" name="customer_service_id" value="{{ auth()->user()->customerService->id ?? '' }}">
                    </div>
                </div>

                {{-- STATUS (readonly informasi) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700">Status</label>
                    <div class="mt-1">
                        <input type="text" readonly
                               class="w-40 rounded-md border-gray-200 bg-gray-50 px-3 py-2"
                               value="{{ old('status', '1 - Pending') }}">
                        <input type="hidden" name="status" value="{{ old('status', 1) }}">
                    </div>
                </div>

                {{-- ORDER ITEMS (dynamic) --}}
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-medium">Items</h3>
                        <button type="button"
                                @click="addItem()"
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-sky-600 text-white text-sm hover:bg-sky-700">
                            + Tambah Item
                        </button>
                    </div>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="mb-3 p-3 border rounded-md bg-gray-50">
                            <div class="flex items-start gap-3">
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                                    {{-- Catalog select --}}
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Gift Catalog</label>
                                        <select
                                            :name="`items[${index}][gift_catalog_id]`"
                                            x-model="item.gift_catalog_id"
                                            @change="if(item.gift_catalog_id === 'add_new'){ openModal() }"
                                            required
                                            class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-1 focus:ring-sky-500 focus:border-sky-500"
                                        >
                                            <option value="">-- Pilih Catalog --</option>
                                            <option value="add_new">
                                                + Tambahkan Catalog Baru
                                            </option>
                                            @foreach($giftCatalogs as $gc)
                                                <option value="{{ $gc->id }}"
                                                    x-bind:value="{{ $gc->id }}">
                                                    {{ $gc->name }} — {{ $gc->platform }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Quantity --}}
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Quantity</label>
                                        <input
                                            type="number"
                                            min="1"
                                            required
                                            :name="`items[${index}][quantity]`"
                                            x-model.number="item.quantity"
                                            class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-1 focus:ring-sky-500 focus:border-sky-500"
                                        />
                                    </div>

                                    {{-- Optional: note / link --}}
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Catatan (opsional)</label>
                                        <input
                                            type="text"
                                            :name="`items[${index}][note]`"
                                            x-model="item.note"
                                            placeholder="Contoh: warna merah, ukuran M"
                                            class="mt-1 block w-full rounded-md border-gray-200 px-3 py-2 shadow-sm focus:ring-1 focus:ring-sky-500 focus:border-sky-500"
                                        />
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="flex flex-col items-center gap-2">
                                    <button type="button"
                                            @click="removeItem(index)"
                                            class="text-red-600 hover:text-red-800 bg-red-50 px-2 py-1 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- If no item --}}
                    <div x-show="items.length === 0" class="text-sm text-slate-500">
                        Belum ada item. Klik <span class="font-medium">Tambah Item</span>.
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 rounded-md border border-slate-200 text-sm">
                        Batal
                    </a>

                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-sky-600 text-white hover:bg-sky-700">
                        Simpan Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div
        x-data
        x-show="$store.modalCatalog.open"
        x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black/40 z-50"
    >
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Tambahkan Catalog Baru</h3>

            <form method="POST" action="{{ route('gift-catalogs.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="text-sm font-medium">Nama Catalog</label>
                    <input type="text" name="name" required
                        class="mt-1 w-full rounded border-gray-300 px-3 py-2">
                </div>

                <div class="mb-3">
                    <label class="text-sm font-medium">Link (opsional)</label>
                    <input type="url" name="link"
                        placeholder="https://example.com"
                        class="mt-1 w-full rounded border-gray-300 px-3 py-2">
                </div>

                <div class="mb-3">
                    <label class="text-sm font-medium">Platform</label>
                    <input type="text" name="platform" required
                        placeholder="Shopee, Tokopedia, Instagram..."
                        class="mt-1 w-full rounded border-gray-300 px-3 py-2">
                </div>

                <div class="flex justify-end mt-4 gap-2">
                    <button type="button"
                            @click="$store.modalCatalog.close()"
                            class="px-3 py-2 border rounded">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 rounded bg-sky-600 text-white">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Alpine.js component --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modalCatalog', {
                open: false,
                open() { this.open = true },
                close() { this.open = false }
            })
        });
        function giftOrderForm() {
            return {
                // init with old inputs if present
                items: (() => {
                    // Try to hydrate from server-rendered old() via JSON encoded variable
                    try {
                        const old = @json(old('items', []));
                        if (Array.isArray(old) && old.length > 0) {
                            return old.map(i => ({
                                gift_catalog_id: i.gift_catalog_id || '',
                                quantity: Number(i.quantity || 1),
                                note: i.note || ''
                            }));
                        }
                    } catch (e) { /* ignore */ }
                    // default single empty row
                    return [{
                        gift_catalog_id: '',
                        quantity: 1,
                        note: ''
                    }];
                })(),

                addItem() {
                    this.items.push({ gift_catalog_id: '', quantity: 1, note: '' });
                    this.$nextTick(() => {
                        // focus last select
                        const selects = this.$el.querySelectorAll('select');
                        if (selects.length) selects[selects.length - 1].focus();
                    });
                },

                removeItem(index) {
                    this.items.splice(index, 1);
                    if (this.items.length === 0) {
                        // keep one blank row to avoid empty POST
                        this.addItem();
                    }
                },
                openModal() {
                    Alpine.store('modalCatalog').open();
                    // Reset kembali dropdown agar tidak tersangkut di value add_new
                    this.items.forEach(i => {
                        if (i.gift_catalog_id === 'add_new') i.gift_catalog_id = '';
                    });
                }
            }
        };
    </script>

</x-app-layout>
