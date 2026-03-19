<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkshopRequest;
use App\Models\Participation;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    public function index(): View
    {
        $department = request('department');

        $query = Workshop::where('status', '>', 1)->orderBy('date', 'asc')->limit(500);

        if (!empty($department)) {
            $query->where('department', $department);
        }

        $workshops      = $query->paginate(20);
        $participations = Participation::orderBy('workshop_id', 'desc')->get();
        $departments    = config('constants.departments');

        return view('home', compact('workshops', 'participations', 'departments'));
    }

    public function create(): View
    {
        $myworkshop  = Workshop::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $departments = config('constants.departments');

        return view('workshop.create', compact('myworkshop', 'departments'));
    }

    public function store(WorkshopRequest $request): RedirectResponse
    {
        $workshop              = new Workshop();
        $workshop->user_id     = $request->user()->id;
        $workshop->slug        = Str::slug(Str::random(10));
        $workshop->name        = $request->get('title');
        $workshop->address     = $request->get('address');
        $workshop->city        = $request->get('city');
        $workshop->postal      = $request->get('postal');
        $workshop->department  = $request->get('postal');
        $workshop->price       = $request->get('price');
        $workshop->org_type    = $request->get('org_type');
        $workshop->age_mini    = $request->get('age_mini');
        $workshop->age_maxi    = $request->get('age_maxi');
        $workshop->effectif_max = $request->get('effectif_max');
        $workshop->maximum     = $request->get('effectif_max');
        $workshop->status      = 1;
        $workshop->date        = Carbon::parse($request->get('date'));
        $workshop->end         = $request->get('end');
        $workshop->parent      = $request->get('parent');
        $workshop->begining    = $request->get('begining');
        $workshop->description = $request->get('description');

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->getClientOriginalName();
            $request->picture->move(public_path('images/workshops'), $imageName);
            $workshop->picture = $imageName;
        }

        $workshop->save();

        return back()->with('message', 'Votre atelier est en attente de validation par un administrateur !');
    }

    public function show(string $slug): View
    {
        $workshop = Workshop::where('slug', $slug)->first();

        return view('workshop.show', compact('workshop', 'slug'));
    }

    public function edit(string $slug): View
    {
        $workshop    = Workshop::where('slug', $slug)->first();
        $departments = config('constants.departments');

        return view('workshop.edit', compact('slug', 'workshop', 'departments'));
    }

    public function update(WorkshopRequest $request, string $slug): View
    {
        $workshops              = Workshop::where('slug', $slug)->first();
        $workshops->name        = $request->get('title');
        $workshops->city        = $request->get('city');
        $workshops->price       = $request->get('price');
        $workshops->org_type    = $request->get('org_type');
        $workshops->age_mini    = $request->get('age_mini');
        $workshops->age_maxi    = $request->get('age_maxi');
        $workshops->effectif_max = $request->get('effectif_max');
        $workshops->maximum     = $request->get('effectif_max');
        $workshops->date        = $request->get('date');
        $workshops->end         = $request->get('end');
        $workshops->parent      = $request->get('parent');
        $workshops->begining    = $request->get('begining');
        $workshops->description = $request->get('description');

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->getClientOriginalName();
            $request->picture->move(public_path('images/workshops'), $imageName);
            $workshops->picture = $imageName;
        }

        $workshops->save();

        $workshop = Workshop::orderBy('created_at', 'desc')->get();

        return view('home', compact('workshop'))->with('message', "L'atelier a bien été modifié");
    }

    public function destroy(int $id): RedirectResponse
    {
        Workshop::findOrFail($id)->delete();

        return back()->with('workshop_delete', 'Votre atelier a bien été supprimé');
    }

    public function nextWS(): View
    {
        $user = Auth::user()->slug;

        $participations = Participation::where('user_id', Auth::user()->id)->get();

        $workshops = Workshop::whereHas('participations', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->paginate(10);

        return view('workshop.next', compact('workshops', 'user', 'participations'));
    }

    public function validateParticipation(Request $request, int $id): RedirectResponse
    {
        $workshops               = Workshop::where('id', $id)->firstOrFail();
        $workshops->effectif_max = $workshops->effectif_max - $request->get('participants');
        $workshops->save();

        $participation               = new Participation();
        $participation->user_id      = Auth::user()->id;
        $participation->workshop_id  = $workshops->id;
        $participation->participants = $request->get('participants');
        $participation->save();

        $user = Auth::user()->slug;

        return redirect()->route('workshop.next', compact('user'))
            ->with('message', "Votre participation à l'atelier est confirmée");
    }

    public function destroyParticipation(int $id): RedirectResponse
    {
        $participation = Participation::where('user_id', Auth::user()->id)
            ->where('workshop_id', $id)
            ->firstOrFail();

        $workshops               = Workshop::where('id', $id)->firstOrFail();
        $workshops->effectif_max = $workshops->effectif_max + $participation->participants;
        $workshops->save();

        $participation->delete();

        $user = Auth::user()->slug;

        return redirect()->route('workshop.next', compact('user'))
            ->with('message', "Votre participation à l'atelier est annulée");
    }

    public function showParticipation(int $id): View
    {
        $participation = Participation::where('id', $id)->firstOrFail();

        return view('workshop.participation', compact('participation'));
    }

    public function createdWorkshops(): View
    {
        $workshops = Workshop::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('workshop.mine', compact('workshops'));
    }
}
