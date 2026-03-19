<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminSheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $sheets = Sheet::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.sheet.index', compact('sheets'));
    }

    public function create()
    {
        return view('admin.sheet.create');
    }

    public function store(Request $request)
    {
        $sheet = new Sheet();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images/sheets'), $imageName);
            $sheet->image = $imageName;
        }

        if ($request->hasFile('file_name')) {
            $fileName = time() . '.' . $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('pdf/sheets/'), $fileName);
            $sheet->file_name = $fileName;
        } else {
            $sheet->file_name = 'default.pdf';
        }

        $sheet->title     = $request->input('title');
        $sheet->age_range = $request->input('age_range');
        $sheet->content   = $request->input('content');
        $sheet->user_id   = Auth::id();
        $sheet->save();

        return Redirect::back()->with('message', 'Fiche Créée !');
    }

    public function show(int $id)
    {
        $sheet = Sheet::findOrFail($id);
        return view('admin.sheet.show', compact('sheet'));
    }

    public function edit(int $id)
    {
        $sheet = Sheet::findOrFail($id);
        return view('admin.sheet.edit', compact('sheet'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title'     => 'required',
            'content'   => 'required',
            'age_range' => 'required',
        ]);

        $sheet = Sheet::findOrFail($id);
        $sheet->title     = $request->input('title');
        $sheet->content   = $request->input('content');
        $sheet->age_range = $request->input('age_range');
        $sheet->save();

        return Redirect::back()->with('message', 'Fiche éditée !');
    }

    public function destroy(int $id)
    {
        Sheet::findOrFail($id)->delete();
        return Redirect::back()->with('message', 'Fiche supprimée !');
    }
}
