<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CguTrue');
        $this->middleware('profilUncomplet');
    }

    public function index(): View
    {
        $user = Auth::user();

        return view('notifications.list', compact('user'));
    }

    public function create(): void {}

    public function store(Request $request): void {}

    public function show(int $id): void {}

    public function edit(int $id): void {}

    public function update(Request $request, int $id): void {}

    public function destroy(int $id): void {}
}
