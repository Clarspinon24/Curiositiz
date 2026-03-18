<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewNetworkInvitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CguTrue');
        $this->middleware('profilUncomplet');
    }

    public function index(): View
    {
        $friends = Auth::user()->friends();

        return view('network.index', compact('friends'));
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(string $slug): void
    {
        //
    }

    public function searchcontact(): View
    {
        return view('network.search');
    }

    public function invitations(string $slug): View
    {
        $user     = User::where('slug', $slug)->first();
        $requests = Auth::user()->friendRequests();

        return view('network.invitations', compact('user', 'slug', 'requests'));
    }

    public function edit(int $id): void
    {
        //
    }

    public function update(Request $request, int $id): void
    {
        //
    }

    public function destroy(int $id): RedirectResponse
    {
        DB::table('friendship')
            ->where('user_id', '=', $id)
            ->orWhere('friend_id', '=', $id)
            ->delete();

        return back()->with('message', 'Ami supprimé');
    }

    public function getAdd(string $slug): RedirectResponse
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('home')->with('info', 'Cet utilisateur n\'existe pas');
        }

        if (Auth::user()->slug === $user->slug) {
            return redirect()->route('user.show', ['slug' => $user->slug]);
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->route('user.show', ['slug' => $user->slug])
                ->with('info', 'Invitation déjà envoyée.');
        }

        if (Auth::user()->isFriendsWith($user)) {
            return redirect()->route('user.show', ['slug' => $user->slug])
                ->with('info', 'Vous êtes déjà amis.');
        }

        $user->notify(new NewNetworkInvitation(Auth::user()));
        Auth::user()->addFriend($user);

        return redirect()->route('network.index')->with('info', 'Demande envoyée');
    }

    public function getAccept(string $slug): RedirectResponse
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('network.index')->with('info', 'Cet utilisateur n\'existe pas');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('network.index');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('network.index')->with('success', 'Demande acceptée');
    }

    public function search(Request $request): View
    {
        $query   = $request->input('q');
        $results = User::where('name', 'LIKE', '%' . $query . '%')
            ->where('id', '!=', Auth::user()->id)
            ->get();

        if ($results->count() > 0) {
            return view('network.search', compact('results', 'query'));
        }

        return view('network.search')->withMessage('Aucun résultat valide !');
    }
}
