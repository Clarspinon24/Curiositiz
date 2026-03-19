<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRateRequest;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AdminRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $rates = Rate::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.rate.index', compact('rates'));
    }

    public function create()
    {
        return view('admin.rate.create');
    }

    public function status(int $id)
    {
        $rate = Rate::findOrFail($id);
        $rate->status = $rate->status === 1 ? 2 : 1;
        $rate->save();

        return back()->with('message', 'Le status de la note a bien été modifié !');
    }

    public function store(StoreRateRequest $request)
    {
        Rate::create([
            'user_id'     => $request->input('user_id'),
            'workshop_id' => $request->input('workshop_id'),
            'status'      => 1,
            'rate'        => $request->input('rate'),
        ]);

        return Redirect::back()->with('message', 'Note ajoutée avec succès !');
    }
}
