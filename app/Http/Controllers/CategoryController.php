<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Helpers\StringGenerator;
use Illuminate\Http\Request;
use App\Traits\ValidateTrait;

class CategoryController extends Controller
{
    use ValidateTrait;

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
        $query = $request->query('query');

        if($sort == 'name_asc') {
            $categories = Category::where("name", "like", "%".$query."%")
                ->orderBy('name', 'ASC')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $categories = Category::where("name", "like", "%".$query."%")
                ->orderBy('name', 'DESC')
                ->paginate($page);
        } else {
            $categories = Category::where("name", "like", "%".$query."%")
                ->orderBy('updated_at', 'DESC')
                ->paginate($page);
        }
        $categories->appends(['query' => $query]);
        $categories->appends(['sort' => $sort]);
        return view('admin.category.index', [
            'categories' => $categories,
            'search' => $query,
        ]);
    }

    /**
     * Search a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("admin/categories?query=".$query);
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
        $this->validateCreateCategory($request);

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

        $page = 20;
        $products = $category->products()->paginate($page);
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
        $this->validateCreateCategory($request);

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
