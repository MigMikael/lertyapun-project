<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Helpers\StringGenerator;
use Illuminate\Http\Request;

class TagController extends Controller
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
            $tags = Tag::orderBy('name', 'ASC')->paginate($page);
        } else if($sort == 'name_desc') {
            $tags = Tag::orderBy('name', 'DESC')->paginate($page);
        } else {
            $tags = Tag::orderBy('updated_at', 'DESC')->paginate($page);
        }
        return view('admin.tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTag = $request->all();
        $newTag['slug'] = (new StringGenerator())->generateSlug();

        $newTag = Tag::create($newTag);
        return redirect()->action([TagController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $products = $tag->products()->get();
        $productIds = $products->pluck('id');
        $allProducts = Product::whereNotIn('id', $productIds)->pluck('name', 'slug');
        return view('admin.tag.show', [
            'tag' => $tag,
            'products' => $products,
            'allProducts' => $allProducts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $newTag = $request->all();
        $tag->update($newTag);
        return redirect()->action([TagController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->action([TagController::class, 'index']);
    }
}
