<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
public function register(): void
{
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required', 
            'string', 
            'lowercase', 
            'email', 
            'max:255', 
            'unique:'.User::class,
            function ($attribute, $value, $fail) {
                if (!DB::table('siswas')->where('email', $value)->exists() && 
                    !DB::table('gurus')->where('email', $value)->exists()) {
                    $fail('Email ini tidak terdaftar sebagai siswa atau guru.');
                }
            }
        ],
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    ], [
        'email.unique' => 'Email ini sudah terdaftar untuk registrasi.'
    ]);

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered(($user = User::create($validated))));

    // Berikan role sesuai tabel dimana email ditemukan
    if (DB::table('gurus')->where('email', $validated['email'])->exists()) {
        $user->assignRole('Guru');
    } else {
        $user->assignRole('Siswa');
    }

    Auth::login($user);
    $this->redirect(route('dashboard', absolute: false), navigate: true);
}
}