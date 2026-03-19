<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $user->firstname = $request->get('firstname');
        $user->lastname  = $request->get('lastname');
        $user->name      = $request->get('firstname') . ' ' . $request->get('lastname');
        $user->email     = $request->get('email');
        $user->phone     = $request->get('phone');
        $user->city      = $request->get('city');
        $user->postal    = $request->get('postal');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/avatars'), $imageName);
            $user->image_name = $imageName;
        }

        $user->save();

        return Redirect::back()->with('message', 'Profil édité !');
    }

    public function destroy(int $id)
    {
        User::findOrFail($id)->delete();
        return Redirect::back()->with('message', 'Profil supprimé !');
    }
}
