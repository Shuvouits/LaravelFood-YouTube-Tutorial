<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('name', 'asc')->get();

        return view('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(CategoryRequest $request)
{
    $data = $request->safe()->except('image');

    $data['status'] = $request->has('status') ? 'yes' : 'no';
    $data['show_home'] = $request->has('show_home') ? 'yes' : 'no';

    $this->categoryService->saveCategory(
        $data,
        $request->file('image')
    );

    return redirect()
        ->route('admin.category.index')
        ->with('success', 'Category Created successfully');
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
        $category = Category::find($id);

        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

   public function update(CategoryRequest $request, string $id)
{
    $data = $request->safe()->except('image');

    $data['status'] = $request->has('status') ? 'yes' : 'no';
    $data['show_home'] = $request->has('show_home') ? 'yes' : 'no';

    $this->categoryService->updateCategory(
        $data,
        $request->file('image'),
        $id
    );

    return redirect()
        ->route('admin.category.index')
        ->with('success', 'Category Updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete associated image if exists
        // Delete the image file if it exists
        if ($category->image) {
            $imagePath = public_path(parse_url($category->image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids; // Array of IDs

        if (is_array($ids) && count($ids)) {
            foreach ($ids as $id) {
                $category = Category::find($id);
                if ($category) {
                    // Unlink image if exists
                    if ($category->image) {
                        $imagePath = public_path(parse_url($category->image, PHP_URL_PATH));
                        if (file_exists($imagePath) && is_file($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                    // Delete the category
                    $category->delete();
                }
            }

            return response()->json(['status' => true, 'message' => 'Selected categories deleted successfully.']);
        }

        return response()->json(['status' => false, 'message' => 'No categories selected.']);
    }


}
