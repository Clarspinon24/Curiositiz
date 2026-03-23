<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function status(int $id)
    {
        $rate = Rate::findOrFail($id);
        $rate->status = $rate->status === 1 ? 2 : 1;
        $rate->save();

        return back()->with('message', 'Le status de la note a bien été modifié !');
    }

    public function destroy(int $id)
    {
        Rate::findOrFail($id)->delete();
        return back()->with('message', 'La notation a bien été supprimée !');
    }
}