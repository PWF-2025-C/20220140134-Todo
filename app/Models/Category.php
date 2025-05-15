<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    
    protected $fillable = ['title', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function todosForCurrentUser()
    {
        return $this->hasMany(Todo::class)->where('user_id', Auth::id());
    }
}