<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCatalog;

class GiftCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $data = $req->validate([
            'name'     => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'link'     => ['nullable', 'url', 'max:500'],
        ]);

        GiftCatalog::create($data);

        return back()->with('success', 'Catalog berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
