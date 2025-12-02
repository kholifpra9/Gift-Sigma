<?php

namespace App\Http\Controllers;

use App\Models\GiftOrder;
use App\Models\GiftOrderItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $csId = auth()->user()->customerService->id;
        return view('dashboard', [
            'totalOrders' => GiftOrder::where('customer_service_id', $csId)->count(),
            'pending' => GiftOrder::where('customer_service_id', $csId)->where('status', 1)->count(),
            'delivered' => GiftOrder::where('customer_service_id', $csId)->where('status', 5)->count(),
            'totalItems' => GiftOrderItem::sum('quantity'),
            'latestOrders' => GiftOrder::where('customer_service_id', $csId)->latest()->take(5)->get(),
        ]);
    }

}
