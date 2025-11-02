<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil! Selamat datang, Admin.');
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Login berhasil! Selamat datang kembali.');
    }

    return back()->with('error', 'Email atau password salah.');
}


    /**
     * Tampilkan halaman register.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru.
     */
  public function register(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'school_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'education_level' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ], [
            // Pesan error khusus
            'email.unique' => 'Email telah terdaftar.',
            'password.confirmed' => 'Kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal harus 6 karakter.',
            'required' => 'Bagian ini wajib diisi.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_name' => $request->school_name,
            'major' => $request->major,
            'education_level' => $request->education_level,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'student', // default role
        ]);

        Auth::login($user);

        return redirect()->route('student.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    } 
    catch (\Illuminate\Validation\ValidationException $e) {
        // Ambil pesan error pertama dari validasi
        $firstError = collect($e->errors())->flatten()->first();
        return back()->with('error', $firstError)->withInput();
    } 
    catch (\Exception $e) {
        // Error lain (misalnya database)
        return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')->withInput();
    }
}


    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
