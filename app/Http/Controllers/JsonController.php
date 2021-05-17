<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        $posts = Post::query()->get();
//        dd($posts);
        return view('welcome',compact('languages','posts'));
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return redirect()->back();
    }
}
