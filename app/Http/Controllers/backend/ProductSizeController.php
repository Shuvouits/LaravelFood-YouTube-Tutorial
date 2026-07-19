<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSizeRequest;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
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
   public function store(ProductSizeRequest $request)
    {
        $validated = $request->validated();

        // old data delete (only if exists)
        ProductSize::where('product_id', $validated['product_id'])->delete();

        // check jodi product_size array thake & not empty
        if (!empty($validated['product_size'])) {
            foreach ($validated['product_size'] as $key => $size) {
                ProductSize::create([
                    'product_id'    => $validated['product_id'],
                    'product_size'  => $size,
                    'product_price' => $validated['product_price'][$key] ?? 0, // fallback jodi price missing hoy
                ]);
            }
        }

        return back()->with('success', 'Product sizes saved successfully.');
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
