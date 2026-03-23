<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController; 
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\AdviceSheetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\AuthSocialController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminSheetController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWorkshopController;
use App\Http\Controllers\Admin\AdminNetworkController;
use App\Http\Controllers\Admin\AdminRateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* REGISTER/LOGIN */
Auth::routes();
Route::get('{provider}', [AuthSocialController::class, 'redirect'])->where('provider', '(facebook|google)');
Route::get('{provider}/callback', [AuthSocialController::class, 'callback'])->where('provider', '(facebook|google)');
Route::get('/changePassword', [HomeController::class, 'showChangePasswordForm']);
Route::post('/changePassword', [HomeController::class, 'changePassword'])->name('changePassword');
Route::get('/user/verify/{token}', [RegisterController::class, 'verifyUser'])->name('verify.user');

/* GLOBAL */
Route::get('/', [WorkshopController::class, 'index'])->name('home');
Route::get('/home', [WorkshopController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::resource('/sheet', AdviceSheetController::class);
Route::get('/sheet/pdf/{id}', [AdviceSheetController::class, 'pdf'])->name('sheet.pdf');
Route::resource('/user', UserController::class);
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/* WORKSHOP */
Route::resource('/workshop', WorkshopController::class)->parameters(['workshop' => 'slug']);
Route::post('/workshop/{slug}/participate', [WorkshopController::class, 'validateParticipation'])->name('workshop.participate');
Route::get('/workshop/{id}/delete', [WorkshopController::class, 'destroy'])->name('workshop.delete');
Route::get('/workshop/{slug}/next', [WorkshopController::class, 'nextWS'])->name('workshop.next');
Route::get('/workshop/{slug}/participation', [WorkshopController::class, 'showParticipation'])->name('workshop.showParticipation');
Route::get('/workshop/{id}/participation/delete', [WorkshopController::class, 'destroyParticipation'])->name('workshop.deleteParticipation');
Route::get('/workshop/{slug}/mine', [WorkshopController::class, 'createdWorkshops'])->name('workshop.mine');

/* LEGAL */
Route::get('/cgu', [LegalController::class, 'cgu'])->name('legal.cgu');
Route::get('/cgu/validate', [LegalController::class, 'validation'])->name('legal.validate');
Route::get('/cgu/validate/accepted', [LegalController::class, 'acceptCGU'])->name('accept_cgu');
Route::post('/curiositiz-admin', [LegalController::class, 'store'])->name('legal.store');

/* RATES */
Route::post('/rate', [RateController::class, 'store'])->name('rate.store');
Route::delete('/rate/{rate}', [RateController::class, 'destroy'])->name('rate.destroy');

/* ADMIN */
Route::get('/curiositiz-admin', [AdminController::class, 'index'])->name('admin');
Route::name('admin.')->prefix('curiositiz-admin')->group(function () {
    Route::resource('/blog', AdminBlogController::class);
    Route::resource('/sheet', AdminSheetController::class);
    Route::get('/sheet/create', [AdminSheetController::class, 'create'])->name('sheet.create');
    Route::resource('/user', AdminUserController::class)->names('user');
    Route::resource('/workshop', AdminWorkshopController::class)->names('workshop');
    Route::get('/workshop/{slug}/approve', [AdminWorkshopController::class, 'approve'])->name('workshop.approve');
    Route::resource('/network', AdminNetworkController::class)->names('network');
    Route::resource('/rate', AdminRateController::class)->names('rate');
    Route::get('/rate/{id}/status', [AdminRateController::class, 'status'])->name('rate.status');
});
