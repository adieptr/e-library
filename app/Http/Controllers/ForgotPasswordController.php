<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutors;
use Illuminate\Support\Facades\Hash; // Import class Hash
use Illuminate\Support\Facades\Cookie;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('lupas');
    }

    public function updatePassword(Request $request)
{
    // Cek apakah email ada di tabel User
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Update password user
        $user->password = Hash::make($request->password);
        $user->save();
        // Redirect ke halaman login setelah berhasil mengupdate password
        return redirect()->intended(route('logreg'))->with('success', 'Password updated successfully. Please login with your new password.');

    }

    // Jika email tidak ditemukan di tabel User, cek di tabel Tutors
    $tutor = Tutors::where('email', $request->email)->first();

    if ($tutor) {
        // Update password tutor
        $tutor->password = Hash::make($request->password);
        $tutor->save();
        // Redirect ke halaman login setelah berhasil mengupdate password
        return redirect()->intended(route('logreg'))->with('success', 'Password updated successfully. Please login with your new password.');

    }

    // Jika email tidak ditemukan di kedua tabel
    return redirect()->back()->with('error', 'Email address not associated with any account.');
}
}

