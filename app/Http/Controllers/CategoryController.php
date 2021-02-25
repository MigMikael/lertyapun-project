<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Helpers\StringGenerator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 10;
        $sort = $request->query('sort');
        if($sort == 'name_asc') {
            $categories = Category::orderBy('name', 'ASC')->paginate($page);
        } else if($sort == 'name_desc') {
            $categories = Category::orderBy('name', 'DESC')->paginate($page);
        } else {
            $categories = Category::orderBy('updated_at', 'DESC')->paginate($page);
        }
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = $request->all();
        $newCategory['slug'] = (new StringGenerator())->generateSlug();

        $newCategory = Category::create($newCategory);
        return redirect()
            ->action([CategoryController::class, 'index'])
            ->with('success', 'Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = $category->products()->get();
        $productIds = $products->pluck('id');
        $allProducts = Product::whereNotIn('id', $productIds)->pluck('name', 'slug');
        return view('admin.category.show', [
            'category' => $category,
            'products' => $products,
            'allProducts' => $allProducts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $newCategory = $request->all();
        $category->update($newCategory);
        return redirect()
            ->action([CategoryController::class, 'index'])
            ->with('success', 'Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()
            ->action([CategoryController::class, 'index'])
            ->with('success', 'Delete Success');
    }
}
