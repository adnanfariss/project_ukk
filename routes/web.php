<?php

use Livewire\Livewire;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Front\Pkl\Index as PklIndex;
use App\Livewire\Front\Industri\Index as industriindex;
use App\Livewire\Front\Siswa\Index as siswaindex;
use App\Livewire\Front\Guru\Index as guruindex;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified', 'check_user_email', 'role:Siswa|Guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

// Route untuk PKL (memerlukan authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/pkl', PklIndex::class)->name('pkl');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/industri', industriindex::class)->name('industri');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/siswa', siswaindex::class)->name('siswa');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/guru', guruindex::class)->name('guru');
});