<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PublicController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);
        return view('welcome', compact('posts'));
    }

    public function singlePost(Post $post)
    {
        return view('singlePost', compact('post'));//post singular: singlePost
    }

    public function about()
    {
        return view('about');
    }

     public function contact()
    {
        return view('contact');
    }

    public function contactPost($id)
    {

    }
}
