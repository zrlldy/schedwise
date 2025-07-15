<?php

use App\Livewire\Auth\ResetPassword;
use App\Livewire\Page\Dashboard;
use App\Livewire\Page\Faculty;
use App\Livewire\Page\Schedule;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get('/reset-password/{token}', ResetPassword::class)
    ->middleware('guest')
    ->name('password.resettoken');

Route::get('/admin/verify-user/{user}', function (Request $request, User $user) {

    if (!$request->hasValidSignature()) {
        abort(403, 'Invalid or expired verification link.');
    }
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    return redirect('/dashboard')->with('status', 'User verified!');
})->middleware('signed')->name('admin.verify');





Route::get('/', function () {
    return view('welcome');
})->name('home');


// Route::view('dashboard', Dashboard::class)
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
route::get('faculty', Faculty::class)
    ->middleware(['auth', 'verified'])
    ->name('faculty');

route::get('schedule', Schedule::class)->middleware(['auth', 'verified'])->name('schedule');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
