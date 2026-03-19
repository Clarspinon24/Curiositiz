<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdviceSheetController extends Controller
{
    public function index(): View
    {
        $sheets = Sheet::all();

        return view('sheet.index', compact('sheets'));
    }

    public function create(): void {}

    public function store(Request $request): void {}

    public function show(int $id): View
    {
        $sheet = Sheet::findOrFail($id);

        return view('sheet.show', compact('sheet'));
    }

    public function edit(int $id): void {}

    public function update(Request $request, int $id): void {}
}
