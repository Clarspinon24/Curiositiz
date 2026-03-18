<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $articles = Article::all();

        return view('blog.index', compact('articles'));
    }

    public function create(): void {}

    public function store(Request $request): void {}

    public function show(int $id): View
    {
        $article = Article::findOrFail($id);

        return view('blog.show', compact('article'));
    }

    public function edit(int $id): void {}

    public function update(Request $request, int $id): void {}

    public function destroy(int $id): void {}
}
