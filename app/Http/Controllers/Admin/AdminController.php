<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Sheet;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $sheets = Sheet::count();
        $articles = Article::count();
        $users = User::count();
        $workshops = Workshop::count();

        return view('admin.index', compact('sheets', 'articles', 'users', 'workshops'));
    }
}
