<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use spatie\permission\Models\Permission;
use spatie\permission\Models\Role;
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage articles');
    }

    public function index() {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function create() {
        return view('admin.articles.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        Article::create($request->all());

        return redirect()->route('article.index')->with('success', 'Article created successfully.');
    }

    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect()->route('article.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('article.index')->with('success', 'Article deleted successfully.');
    }
}
?>

