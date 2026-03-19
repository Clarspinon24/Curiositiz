<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfil;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CguTrue');
        $this->middleware('profilUncomplet');
    }

    public function index(): void {}

    public function create(): void {}

    public function store(Request $request): void {}

    public function show(string $slug): View|RedirectResponse
    {
        $user = User::where('slug', $slug)->first();

        if (Auth::user()->slug !== $user->slug) {
            return redirect('/login');
        }

        return view('profil.edit', compact('user', 'slug'));
    }

    public function edit(string $slug): View|RedirectResponse
    {
        $user      = User::where('slug', $slug)->first();
        $imageLink = $user->avatar();

        if (Auth::user()->slug !== $user->slug) {
            return redirect('/login');
        }

        return view('profil.edit', compact('user', 'slug', 'imageLink'));
    }

    public function update(UpdateProfil $request, string $slug): RedirectResponse
    {
        $user        = User::where('slug', $slug)->first();
        $passwordIsOk = password_verify($request->get('password'), Auth::user()->getAuthPassword());

        // Utilisateur social (pas de mot de passe défini)
        $noPassword = empty(Auth::user()->password);

        if ($passwordIsOk || $noPassword) {
            $user->email  = $request->get('email');
            $user->phone  = $request->get('phone');
            $user->city   = $request->get('city');
            $user->postal = $request->get('postal');

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalName();
                $request->image->move(public_path('images/avatars'), $imageName);
                $user->image_name = $imageName;
            }

            $user->save();

            return redirect()->route('profil.edit', ['slug' => Auth::user()->slug])
                ->with('message', 'Vos informations ont bien été mises à jour');
        }

        return redirect()->back()->withErrors(['password' => 'Mauvais mot de passe']);
    }

    public function destroy(int $id): void {}
}
