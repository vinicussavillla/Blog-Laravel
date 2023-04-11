<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Contracts\View\Share;
use Illuminate\Contracts\View\View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use PhpParser\Node\Expr\AssignOp\Pow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
        setlocale(LC_TIME, 'pt-br');


        Paginator::useBootstrap();
    
        $categories = Category::where('status', 1)->orderBy('order_by', 'asc')->get();

        $tags = Tag::where('status', 1)->orderBy('order_by', 'asc')->get();
        $recents_post = Post::where('is_approved', 1)->where('status', 1)->latest()->take(5)->get();
    
        view()->share(['categories' => $categories, 'tags' => $tags, 'recents_post' => $recents_post]);
    }
}
