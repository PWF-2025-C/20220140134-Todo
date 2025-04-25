<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index(){
        // $todos = Todo::all();
        $todos = Todo::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        // dd($todos);
        return view("todo.index", compact('todos'));
    }
    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    $todo = new Todo();
    $todo->title = $request->title;
    $todo->is_done = false;
    $todo->user_id = Auth::id(); // 👈 ini penting
    $todo->save();

    return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
}

    public function edit()
    {
        return view('todo.edit', compact('todo'));
    }
}
