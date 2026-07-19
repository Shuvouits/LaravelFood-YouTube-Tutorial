<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionalItemRequest;
use App\Models\OptionalItem;
use Illuminate\Http\Request;

class OptionalItemController extends Controller
{
    //

     public function store(OptionalItemRequest $request)
    {




        $validated = $request->validated();

        // old data delete (only if exists)
        OptionalItem::where('product_id', $validated['product_id'])->delete();


        // check jodi product_size array thake & not empty
        if (!empty($validated['item_name'])) {
            foreach ($validated['item_name'] as $key => $item) {
                OptionalItem::create([
                    'product_id'    => $validated['product_id'],
                    'item_name'  => $item,
                    'price' => $validated['price'][$key],
                ]);
            }
        }

        return back()->with('success', 'Product sizes saved successfully.');
    }


}
