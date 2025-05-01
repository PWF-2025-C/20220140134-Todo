<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = User::query()
            ->where('id', '!=', 1)
            ->orderBy('name');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function makeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->is_admin = true;
            $user->save();

            return back()->with('success', 'Make admin successfully!');
        }

        return redirect()->route('user.index');
    }

    public function removeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->is_admin = false;
            $user->save();

            return back()->with('success', 'Remove admin successfully!');
        }

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
{
    if ($user->id != 1) {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    } else {
        return redirect()->route('user.index')->with('danger', 'Cannot delete this user!');
    }
}
}