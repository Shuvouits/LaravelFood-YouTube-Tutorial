<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\ImageGallery;
use App\Models\OptionalItem;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $product = Product::latest()->get();

        return view('backend.product.index', compact('product'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'asc')->get();

        return view('backend.product.create', compact('category'));
    }

    public function productSetting($id)
    {
        $product = Product::find($id);
        $productSize = ProductSize::where('product_id', $id)->get();

        $optionalItem = OptionalItem::where('product_id', $id)->get();

        return view('backend.product.setting', compact('product', 'productSize', 'optionalItem'));
    }

    public function productGallery($id)
    {
        $product = Product::find($id);
        $product_gallery = ImageGallery::where('product_id', $id)->get();

        return view('backend.product.gallery', compact('product', 'product_gallery'));

    }

    public function store(ProductRequest $request)
    {

        $this->productService->saveProduct($request->validated(), $request->file('image'));

        return redirect()->back()->with('success', 'Product Created successfully');
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        $category = Category::orderBy('name', 'asc')->get();

        return view('backend.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $this->productService->updateProduct($request->validated(), $request->file('image'), $id);

        return redirect()->back()->with('success', 'Product Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete associated image if exists
        // Delete the image file if it exists
        if ($product->image) {
            $imagePath = public_path(parse_url($product->image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids; // Array of IDs

        if (is_array($ids) && count($ids)) {
            foreach ($ids as $id) {
                $product = Product::find($id);
                if ($product) {
                    // Unlink image if exists
                    if ($product->image) {
                        $imagePath = public_path(parse_url($product->image, PHP_URL_PATH));
                        if (file_exists($imagePath) && is_file($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                    // Delete the category
                    $product->delete();
                }
            }

            return response()->json(['status' => true, 'message' => 'Selected products deleted successfully.']);
        }

        return response()->json(['status' => false, 'message' => 'No products selected.']);
    }
}
