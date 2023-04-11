<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $query =  Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(6)->get(); 
        
        return view('frontend.modules.index', compact('posts', 'slider_posts'));
    }

    public function all_post()
    {        
        $posts = Post::with('category', 'sub_category','tag', 'user')->where('is_approved', 1)->where('status', 1)->latest()->paginate(6);        
        $title = 'Todas as Postagens'; 
        $sub_title = 'Ver toda a lista de Postagens';
        return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
    }

    public function search(Request $request )
    {        
        $posts = Post::with('category', 'sub_category','tag', 'user')
        ->where('is_approved', 1)
        ->where('status', 1)
        ->where('title', 'like', '%'.$request->input('search').'%')
        ->latest()
        ->paginate(6);      
        $title = 'Ver resultado da pesquisa'; 
        $sub_title = $request->input('search');
    return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));

    }

    public function category($slug)
    {        
        $category = Category::where('slug', $slug)->first();
         if ($category){
            $posts = Post::with('category','sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(6);      
         }

        $title = $category->name;
 
        $sub_title = 'Postagens por categoria';
    return view('frontend.modules.all_post', compact('posts','title', 'sub_title'));
        
    }


    public function sub_category($slug, $sub_slug)
    {        
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
         if ($sub_category){
            $posts = Post::with('category', 'sub_category','tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->paginate(6);      
         }

        $title = $sub_category->name; 
        $sub_title = 'Postagens por Subcategoria';
    return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));
        
    }


    public function tag(string $slug)
    {        

        $tag = Tag::with('post')->where('slug', $slug)->first();

        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');
         
        if ($tag){

            $posts = Post::with('category', 'sub_category','tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->whereIn('id',$post_ids)
            ->latest()
            ->paginate(10);      
         }

         
        $title = $tag->name; 
        $sub_title = 'Postagens por Tags';
    return view('frontend.modules.all_post', compact('posts', 'title', 'sub_title'));  
        
    }


    public function single(string $slug)
    {        
        $post = Post::with('category', 'sub_category','tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
          return view('frontend.modules.single', compact('post'));
    }


}
