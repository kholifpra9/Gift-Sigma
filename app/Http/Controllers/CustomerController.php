<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function store(Request $req)
    {
        $data = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
        ]);

        Customer::create($data);

        return back()->with('success', 'Customer berhasil ditambahkan.');
    }
}
