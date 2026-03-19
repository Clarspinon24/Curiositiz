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

    public function index(): void {}

    public function create(): void {}

    public function store(Request $request): void {}

    public function show(Rate $rate): void {}

    public function edit(Rate $rate): void {}

    public function update(Request $request, Rate $rate): void {}

    public function destroy(Rate $rate): void {}
}
