<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWorkshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $workshops   = Workshop::orderBy('date', 'desc')->paginate(20);
        $departments = config('constants.departments');

        return view('admin.workshop.index', compact('workshops', 'departments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $slug)
    {
        $workshop = Workshop::where('slug', $slug)->firstOrFail();
        return view('admin.workshop.show', compact('workshop', 'slug'));
    }

    public function edit(string $slug)
    {
        $workshop    = Workshop::where('slug', $slug)->firstOrFail();
        $departments = config('constants.departments');

        return view('admin.workshop.edit', compact('slug', 'workshop', 'departments'));
    }

    public function update(Request $request, string $slug)
    {
        $workshop = Workshop::where('slug', $slug)->firstOrFail();

        $workshop->name         = $request->get('title');
        $workshop->city         = $request->get('city');
        $workshop->postal       = $request->get('postal');
        $workshop->department   = $request->get('postal');
        $workshop->price        = $request->get('price');
        $workshop->org_type     = $request->get('org_type');
        $workshop->age_mini     = $request->get('age_mini');
        $workshop->age_maxi     = $request->get('age_maxi');
        $workshop->effectif_max = $request->get('effectif_max');
        $workshop->date         = $request->get('date');
        $workshop->end          = $request->get('end');
        $workshop->parent       = $request->get('parent') === 'on';
        $workshop->begining     = $request->get('begining');
        $workshop->description  = $request->get('description');

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->getClientOriginalName();
            $request->picture->move(public_path('images/workshops'), $imageName);
            $workshop->picture = $imageName;
        }

        $workshop->save();

        return back()->with('message', "L'atelier a bien été modifié !");
    }

    public function approve(string $slug)
    {
        $workshop = Workshop::where('slug', $slug)->firstOrFail();
        $workshop->status = 2;
        $workshop->save();

        return back()->with('message', "L'atelier a bien été approuvé !");
    }

    public function destroy(int $id)
    {
        DB::table('workshop')->delete($id);
        DB::table('workshop_participation_list')->where('workshop_id', $id)->delete();

        return back();
    }
}
