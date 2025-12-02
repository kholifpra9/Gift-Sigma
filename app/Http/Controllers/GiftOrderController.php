<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerService;
use App\Models\GiftCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GiftOrderController extends Controller
{
    public function create()
    {
        return view('gift_orders.create', [
            'giftCatalogs' => GiftCatalog::orderBy('name')->get(),
            'customers' => Customer::orderBy('name')->get(),
            'customerServices' => CustomerService::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'customer_service_id' => 'required|exists:customer_services,id',
            'status' => 'nullable|integer',
            'items' => 'required|array|min:1',
            'items.*.gift_catalog_id' => 'required|exists:gift_catalogs,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.note' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $order = \App\Models\GiftOrder::create([
                'customer_id' => $data['customer_id'],
                'customer_service_id' => $data['customer_service_id'],
                'status' => $data['status'] ?? 1,
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'gift_catalog_id' => $item['gift_catalog_id'],
                    'quantity' => $item['quantity'],
                    // save note if your table has it (you can add column)
                    // 'note' => $item['note'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('gift-orders.create')->with('success', 'Gift order berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Gift order create failed: '.$e->getMessage());
            return back()->withErrors(['err' => 'Terjadi kesalahan saat menyimpan order.'])->withInput();
        }
    }

}
