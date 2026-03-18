<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.blog.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        $article = new Article();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/articles'), $imageName);
            $article->image = $imageName;
        }

        $article->title   = $request->title;
        $article->content = $request->content;
        $article->user_id = auth()->id();
        $article->save();

        return back()->with('message', 'Article créé !');
    }

    public function edit(int $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.blog.edit', compact('article'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        $article = Article::findOrFail($id);

        if ($article->user_id !== auth()->id()) {
            return redirect('/articles')->with('error', 'Non autorisé');
        }

        $article->update([
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/articles'), $imageName);
            $article->update(['image' => $imageName]);
        }

        return back()->with('message', 'Article modifié !');
    }

    public function destroy(int $id)
    {
        Article::findOrFail($id)->delete();
        return back();
    }
}
