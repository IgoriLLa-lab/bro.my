<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(10); // Получаем список статей с пагинацией

        return view('welcome', compact('articles'));
    }
}
