<?php

namespace App\Http\Controllers;

use App\Models\User;

class NewsController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('news.index', compact('users'));
    }
}
