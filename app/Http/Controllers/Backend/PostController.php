<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpadateRequest;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'sub_category', 'user', 'tag')->latest()->paginate(15); 
        /*dd($posts);*/   
        return view('backend.modules.post.index', compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {          
        $selected_tags = [];

        $categories = Category::where('status', 1)->pluck('name', 'id');         
        $tags = Tag::where('status', 1)->select('name', 'id')->get(); 
        return view('backend.modules.post.create', compact('categories', 'tags', 'selected_tags')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
       $post_data = $request->except(['tag_ids','photo', 'slug', 'id' ]);
       $post_data['slug'] = Str::slug($request->input('slug'));
       $post_data['user_id'] = Auth::user()->id;
       $post_data['is_approved'] = 1;

       if($request->hasFile('photo')){
          $file = $request->file('photo');
          $name = Str::slug($request->input('slug'));
          $height = 400;
          $widht = 1000;
          $thumb_height = 150; 
          $thumb_widht = 300;
          $path = '/image/post/original/';
          $thumb_path = '/image/post/thumbnail/'; 
          $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $widht, $path, $file);
          PhotoUploadController::imageUpload($name, $thumb_height, $thumb_widht, $thumb_path, $file);

       }
        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));
        
        session()->flash('cls', 'success'); 
        session()->flash('msg', 'SubCategoria  Criada com  Sucesso!!'); 
        return redirect()->route('post.index'); 


    
        // Relação muitos para muitos ->pivot table 
        // post id 1 -> tag_id = 1, 2, 3
        // tag_id = 1 -> post_id = 2, 5, 8
        // post_id     tag_id 
        //   1            1
        //   1            2
        //   1            3
       //   2            1
       //   5            1
       //   8            1

       //     POST TAGS
       //1. singular post_tag

    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['category', 'sub_category', 'user', 'tag']);
        return view('backend.modules.post.show', compact('post')); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {   
        $categories = Category::where('status', 1,)->pluck('name', 'id'); 
        $tags = Tag::where('status', 1)->select('name', 'id')->get();
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id')->toArray();
         //$post->load('tag');
         //$selected_tags = $post->tag->pluck('id')->toArray();
       // dd($selected_tags);
        return view('backend.modules.post.edit', compact('post', 'categories', 'tags', 'selected_tags')); 

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpadateRequest $request, Post $post)
    {
        $post_data = $request->except(['tag_ids','photo', 'slug', 'id' ]);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['is_approved'] = 1;
 
        if($request->hasFile('photo')){
           $file = $request->file('photo');
           $name = Str::slug($request->input('slug'));
           $height = 400;
           $widht = 1000;
           $thumb_height = 150; 
           $thumb_widht = 300;
           $path = '/image/post/original/';
           $thumb_path = '/image/post/thumbnail/'; 
           PhotoUploadController::imageUnlink($path, $post->photo);
           PhotoUploadController::imageUnlink($thumb_path, $post->photo);

           $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $widht, $path, $file);
           PhotoUploadController::imageUpload($name, $thumb_height, $thumb_widht, $thumb_path, $file);
 
        }
         $post->update($post_data);
         $post->tag()->sync($request->input('tag_ids'));

        session()->flash('cls', 'success'); 
        session()->flash('msg', 'Publicação Atualizada com  Sucesso!!'); 
        return redirect()->route('post.index'); 

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete(); 
        session()->flash('cls', 'danger'); 
        session()->flash('msg', 'Publicação  Excluída com  Sucesso!!'); 
        return redirect()->route('post.index');
    }
}
