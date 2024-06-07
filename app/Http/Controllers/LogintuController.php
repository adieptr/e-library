<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutors;
use Illuminate\Support\Facades\Hash; // Import class Hash
use Illuminate\Support\Facades\Cookie;

class LogintuController extends Controller
{
    public function index()
    {
        return view('tambahtutor');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();
            $tutor = Tutors::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Cookie::queue('user_id', $user->id, 60*24*30);
                // Jika login berhasil sebagai user
                return redirect()->intended('/dashboarduser');
            } elseif ($tutor && Hash::check($request->password, $tutor->password)) {
                if ($tutor->role === 'guru') {
                    Cookie::queue('tutor_id', $tutor->id, 60*24*30);
                    // Jika login berhasil sebagai tutor guru
                    return redirect()->intended('/dashboardad');
                } elseif ($tutor->role === 'superadmin') {
                    Cookie::queue('sp_id', $tutor->id, 60*24*30);
                    // Jika login berhasil sebagai tutor superadmin
                    return redirect()->intended('/dashboardsp');
                } else {
                    // Jika rolenya tidak terdefinisi atau tidak valid
                    return redirect()->back()->with('error', 'Invalid role.');
                }
            } else {
                // Jika email atau password salah di kedua tabel
                return redirect()->back()->with('error', 'Email atau Password yang Anda Masukkan Salah');
            }
        }

        // Jika metode bukan POST, kembalikan ke halaman login
        // return view('logreg');
    }

}

