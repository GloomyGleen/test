<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function index() {
        
        //Redis::set('mykey', 'Hello world2!');
        // $temp = Redis::get('mykey');
        // dd($temp);
        $posts = Post::with('category')->orderByDesc('created_at')->paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function show($slug){
        $post= Post::where('slug', $slug)->firstOrFail();
        $post->views += 1;
        $post->update();
        return view('posts.show', compact('post'));
    }
}
