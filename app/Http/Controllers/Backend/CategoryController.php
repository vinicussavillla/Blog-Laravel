<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('order_by')->get();
        return view('backend.modules.category.index', compact('categories')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.category.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
      $category_data = $request->all();
      $category_data['slug'] = Str::slug($request->input('slug'));
      Category::create($category_data);
      session()->flash('cls', 'success'); 
      session()->flash('msg', 'Categoria  Criada com  Sucesso!!'); 
      return redirect()->route('category.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('backend.modules.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories,slug,'.$category->id,
            'order_by' => 'required|numeric',
            'status' => 'required',
        ]); 
        

        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));
        $category->update($category_data);
        session()->flash('cls', 'success'); 
        session()->flash('msg', 'Categoria  Atualizada com  Sucesso!!'); 
        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete(); 
        session()->flash('cls', 'danger'); 
        session()->flash('msg', 'Categoria  Excluída com  Sucesso!!'); 
        return redirect()->route('category.index');
    }
}
