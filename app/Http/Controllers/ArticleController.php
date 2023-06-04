<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::withCount(['likeDislikes as rating' => function ($query) {
            $query->select(DB::raw('SUM(sum)'));
        }])
            ->orderByDesc('rating')
            ->orderBy('created_at')
            ->paginate(10);

        return view('welcome', compact('articles'));
    }
}
