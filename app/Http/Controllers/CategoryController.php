<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $categories = Category::withCount(['todos' => function ($query) {
        $query->where('user_id', Auth::id());
    }])->where('user_id', Auth::id())->get();

    return view('categories.index', compact('categories'));
}


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Category::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('categories.index');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(['title' => 'required']);
        $category = Category::findOrFail($id);
        $category->update(['title' => $request->title]);
        return redirect()->route('categories.index');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
