<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class JsonController extends Controller
{
    public function index()
    {
        $languages = Language::query()->select('language')->where('is_active', '=', 1)->get();
        $posts = Post::query()->get();
        return view('welcome', compact('languages', 'posts'));
    }

    public function store(Request $request)
    {
//        return $request->input('title');
        $post = Post::create($request->all());
        return redirect()->back();
    }

    public function changeLocale($locale)
    {
        $availableLocale = Language::query()->where('language', '=',$locale)->where('is_active', '=', 1)->pluck('language')->toArray();
        if (!in_array($locale, $availableLocale)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }
}
