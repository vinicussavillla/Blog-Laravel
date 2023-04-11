<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('order_by')->get();
        return view('backend.modules.tag.index', compact('tags')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tag.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:tags',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ]); 

      $tag_data = $request->all();
      $tag_data['slug'] = Str::slug($request->input('slug'));
      Tag::create($tag_data);
      session()->flash('cls', 'success'); 
      session()->flash('msg', 'Tag  Criada com  Sucesso!!'); 
      return redirect()->route('tag.index'); 
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('backend.modules.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
       return view('backend.modules.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:tags,slug,'.$tag->id,
            'order_by' => 'required|numeric',
            'status' => 'required',
        ]); 

        $tag_data = $request->all();
        $tag_data['slug'] = Str::slug($request->input('slug'));
        $tag->update($tag_data);
        session()->flash('cls', 'success'); 
        session()->flash('msg', 'Tag  Atualizada com  Sucesso!!'); 
        return redirect()->route('tag.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete(); 
        session()->flash('cls', 'danger'); 
        session()->flash('msg', 'Tag  Excluída com  Sucesso!!'); 
        return redirect()->route('tag.index');
    }
}
