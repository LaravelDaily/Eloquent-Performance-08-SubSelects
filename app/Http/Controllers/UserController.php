<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
//        $users = User::with('lastPost')->get();

        $users = User::addSelect(['lastPost' => Post::select('created_at')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1)
        ])->get();

        return view('users.index', compact('users'));
    }
}
