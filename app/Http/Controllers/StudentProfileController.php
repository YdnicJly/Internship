<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    public function index()
    {
        return view('student.profile');
    }

public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'school_name' => 'required|string|max:255',
        'major' => 'required|string|max:255',
        'education_level' => 'required|string|max:50',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 🔹 Path tujuan ke dalam public_html/profiles
    $destinationPath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/profiles';

    // Buat folder kalau belum ada
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // 🔹 Hapus foto lama & upload baru
    if ($request->hasFile('profile_photo')) {
        // Hapus file lama (kalau ada)
        if ($user->profile_photo && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $user->profile_photo)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $user->profile_photo);
        }

        // Simpan file baru
        $filename = time() . '_' . uniqid() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
        $request->file('profile_photo')->move($destinationPath, $filename);

        // Simpan path relatif untuk akses via URL (misal: profiles/nama_file.jpg)
        $validated['profile_photo'] = 'profiles/' . $filename;
    }

    $user->update($validated);

    return back()->with('success', 'Profil berhasil diperbarui!');
}


    /**
     * 🔐 Fitur ubah password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
