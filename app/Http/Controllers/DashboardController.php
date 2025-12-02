<?php

namespace App\Http\Controllers;

use App\Models\GiftOrder;
use App\Models\GiftOrderItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalOrders' => GiftOrder::count(),
            'pending' => GiftOrder::where('status', 1)->count(),
            'delivered' => GiftOrder::where('status', 5)->count(),
            'totalItems' => GiftOrderItem::sum('quantity'),
            'latestOrders' => GiftOrder::latest()->take(5)->get(),
        ]);
    }

}
