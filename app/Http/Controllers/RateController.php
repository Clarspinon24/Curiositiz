<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CguTrue');
        $this->middleware('profilUncomplet');
    }

    // Enregistrer une nouvelle note
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'workshop_id' => 'required|exists:workshop,id',
            'rate'        => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string|max:500',
        ]);

        // Vérifier si l'user a déjà noté ce workshop
        if (Rate::alreadyRated(auth()->id(), $request->workshop_id)) {
            return back()->with('error', 'Vous avez déjà noté cet atelier.');
        }

        // Créer la note
        Rate::create([
            'user_id'     => auth()->id(),
            'workshop_id' => $request->workshop_id,
            'rate'        => $request->rate,
            'comment'     => $request->comment,
            'status'      => 1,
        ]);

        return back()->with('success', 'Votre avis a été enregistré !');
    }

    // Supprimer une note
    public function destroy(Rate $rate)
    {
        // Vérifier la permission via la Policy
        $this->authorize('delete', $rate);

        $rate->delete();

        return back()->with('success', 'Avis supprimé.');
    }
}