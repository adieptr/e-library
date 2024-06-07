<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutors;
use Illuminate\Support\Facades\Hash; // Import class Hash
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('logreg');
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
                Cookie::queue('user_id', $user->id, 4320);
                // Jika login berhasil sebagai user
                return redirect()->intended('/dashboarduser');
            } elseif ($tutor && Hash::check($request->password, $tutor->password)) {
                if ($tutor->role === 'guru') {
                    Cookie::queue('tutor_id', $tutor->id, 4320);
                    // Jika login berhasil sebagai tutor guru
                    return redirect()->intended('/dashboardad');
                } elseif ($tutor->role === 'superadmin') {
                    Cookie::queue('sp_id', $tutor->id, 4320);
                    // Jika login berhasil sebagai tutor superadmin
                    return redirect()->intended('/dashboardsp');
                } else {
                    // Jika rolenya tidak terdefinisi atau tidak valid
                    return redirect()->back()->with('error', 'Role Tidak Terdaftar');
                }
            } else {
                // Jika email atau password salah di kedua tabel
                return redirect()->back()->with('error', 'Kesalahan Pada Email Dan Password');
            }
        }

        // Jika metode bukan POST, kembalikan ke halaman login
        // return view('logreg');
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
        return redirect()->intended('/logreg');

    }

    // Jika email tidak ditemukan di tabel User, cek di tabel Tutors
    $tutor = Tutors::where('email', $request->email)->first();

    if ($tutor) {
        // Update password tutor
        $tutor->password = Hash::make($request->password);
        $tutor->save();
        // Redirect ke halaman login setelah berhasil mengupdate password
        return redirect()->intended('/logreg');

    }

    // Jika email tidak ditemukan di kedua tabel
    return redirect()->back()->with('error', 'Alamat email yang Anda masukkan tidak sama dengan alamat email manapun');
}


public function logoutsp()
{
    // Hapus cookie 'sp_id'
    Cookie::queue(Cookie::forget('sp_id'));

    // Redirect kembali ke halaman login
    return redirect()->route('loginnn')->with('success', 'Logout berhasil');
}

public function logoutad()
{
    // Hapus cookie 'sp_id'
    Cookie::queue(Cookie::forget('tutor_id'));

    // Redirect kembali ke halaman login
    return redirect()->route('loginnn')->with('success', 'Logout berhasil');
}

public function logoutsiswa()
{
    // Hapus cookie 'sp_id'
    Cookie::queue(Cookie::forget('user_id'));

    // Redirect kembali ke halaman login
    return redirect()->route('loginnn')->with('success', 'Logout berhasil');
}

}

