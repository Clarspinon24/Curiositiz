<?php

namespace App\Http\Controllers;

use App\Models\Cgu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LegalController extends Controller
{
    public function cgu(): View
    {
        return view('legal.cgu');
    }

    public function store(Request $request): RedirectResponse
    {
        Storage::delete(public_path('pdf/CGU.pdf'));

        $cgu = new Cgu();

        if ($request->hasFile('file')) {
            $fileName = Storage::putFileAs('cgu', $request->file('file'), 'CGU.pdf');
            $request->file->move(public_path('pdf/cgu/'), $fileName);
            $cgu->link = $fileName;
        }

        $cgu->save();

        return redirect()->back()->with('message', 'Les CGU ont bien été mises à jour');
    }

    public function validation(): View
    {
        return view('legal.validate');
    }

    public function acceptCGU(): RedirectResponse
    {
        Auth::user()->update(['cgu' => 1]);

        return redirect('home');
    }
}
