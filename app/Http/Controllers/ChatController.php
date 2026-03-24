<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    // Liste des conversations de l'utilisateur connecté
    public function index()
    {
        $userId = Auth::id();
        $conversations = Conversation::with(['workshop', 'participant', 'organizer', 'messages' => function($q) {
        $q->latest()->limit(1);
        }])
        ->where('participant_id', $userId)
        ->orWhere('organizer_id', $userId)
        ->latest()
        ->get();
        return view('chat.index', compact('conversations'));
    }

    // Afficher une conversation
 public function show(Conversation $conversation)
{
    $this->authorize('view', $conversation);

    $userId = Auth::id();

    // Marquer les messages comme lus
    $conversation->messages()
        ->where('sender_id', '!=', $userId)
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    $messages = $conversation->messages()->with('sender')->oldest()->get();
    $workshop = $conversation->workshop;
    $otherUser = $conversation->participant_id === $userId
        ? $conversation->organizer
        : $conversation->participant;

    // Pour la liste de gauche
    $conversations = Conversation::with(['workshop', 'participant', 'organizer'])
        ->where('participant_id', $userId)
        ->orWhere('organizer_id', $userId)
        ->latest()
        ->get();
    return view('chat.show', compact('conversation', 'conversations', 'messages', 'workshop', 'otherUser'));
}

    // Créer ou accéder à une conversation depuis un atelier
    public function createOrShow(Workshop $workshop)
    {
        $userId = Auth::id();
        $organizerId = $workshop->user_id;

        if ($userId === $organizerId) {
            abort(403, 'Vous êtes l\'organisateur de cet atelier.');
        }

        $conversation = Conversation::firstOrCreate([
            'workshop_id'    => $workshop->id,
            'participant_id' => $userId,
            'organizer_id'   => $organizerId,
        ]);

        return redirect()->route('chat.show', $conversation);
    }

    // Envoyer un message
    public function store(Request $request, Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $request->validate(['body' => 'required|string|max:1000']);

        $userId = Auth::id();
        $receiverId = $conversation->participant_id === $userId
            ? $conversation->organizer_id
            : $conversation->participant_id;

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => $userId,
            'receiver_id'     => $receiverId,
            'body'            => $request->body,
        ]);

        return back();
    }

    // Polling pour les nouveaux messages
    public function poll(Request $request, Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $lastId = $request->input('last_id', 0);

        $messages = $conversation->messages()
            ->with('sender')
            ->where('id', '>', $lastId)
            ->oldest()
            ->get()
            ->map(fn($m) => [
                'id'         => $m->id,
                'body'       => $m->body,
                'mine'       => $m->sender_id === Auth::id(),
                'created_at' => $m->created_at->format('H:i'),
            ]);

        // Marquer comme lus
        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['messages' => $messages]);
    }
}
