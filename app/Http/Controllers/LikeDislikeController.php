<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\LikeDislike;
use Illuminate\Http\Request;

class LikeDislikeController extends Controller
{
    public function like(Request $request, Article $article): \Illuminate\Http\RedirectResponse
    {
        LikeDislike::create([
            'article_id' => $article->id,
            'sum' => 1,
        ]);

        return back();
    }

    public function dislike(Request $request, Article $article): \Illuminate\Http\RedirectResponse
    {
        LikeDislike::create([
            'article_id' => $article->id,
            'sum' => -1,
        ]);

        return back();
    }
}
