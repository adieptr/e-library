<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutors;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class PagesControllerUser extends Controller
{
    public function index()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        if (!$userId) {
            // If the cookie is not present, redirect to the login/registration page
            return redirect()->route('login');
        }

        $user = User::find($userId); // Find the user based on the ID

        if (!$user) {
            // If the user is not found, redirect to the login/registration page
            return redirect()->route('login');
        } // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image; // Ambil URL gambar profil pengguna

        return view('components.userheader', [
            "title" => "Dashboard User",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }

    public function dashboard()
    {
        $playlists = Tutors::where('role', 'guru')->get();
        $materi = Playlist::all();
        foreach ($materi as $mat) {
            $tutor = Tutors::find($mat->tutor_id);
            $mat->tutor = $tutor;
        }
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId);
        if ($user) { // Temukan pengguna berdasarkan ID
            $userName = $user->name; // Ambil nama pengguna
            $userImage = $user->image;


            return view('dashboarduser', [
                "title" => "Dashboard User",
                "userName" => $userName,
                "userImage" => $userImage,
                "playlists" => $playlists,
                "materi" => $materi // Teruskan nama pengguna ke tampilan
            ]);
        } else {
            return redirect()->route('loginnn');
        }
    }

    public function profileuser()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('profileuser', [
            "title" => "Profile User",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function edit()
    {
        // Ambil ID pengguna dari cookie
        $userId = Cookie::get('user_id');

        // Temukan data pasien berdasarkan ID pengguna
        $data = User::where('user_id', $userId)->first();

        // Jika data tidak ditemukan, berikan pesan atau tindakan yang sesuai

        // Kirim data ke tampilan editpasien.blade.php
        return view('updateprofileu', compact('data'));
    }


    public function update(Request $request)
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie

        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $prev_pass = $user->password;
        $prev_image = $user->image;

        $name = $request->input('name');
        // Validasi dan filter input nama
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        if (!empty($name)) {
            $user->name = $name;
            $message[] = 'Username updated successfully!';
        }

        $email = $request->input('email');
        // Validasi dan filter input email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!empty($email)) {
            // Cek apakah email sudah ada di database
            $existingEmail = User::where('email', $email)->exists();
            if ($existingEmail) {
                $message[] = 'Email already taken!';
            } else {
                $user->email = $email;
                $message[] = 'Email updated successfully!';
            }
        }

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Validasi ukuran gambar
            if ($image->getSize() > 2000000) {
                $message[] = 'Image size too large!';
            } else {
                $imageExtension = $image->getClientOriginalExtension();
                $rename = uniqid() . '.' . $imageExtension;
                $image->move('uploaded_files/', $rename);
                $user->image = $rename;
                // Hapus gambar sebelumnya jika ada
                if (!empty($prev_image) && $prev_image != $rename) {
                    File::delete(public_path('uploaded_files/' . $prev_image));
                }
                $message[] = 'Image updated successfully!';
            }
        }

        $oldPass = $request->input('old_pass');
        $newPass = $request->input('new_pass');
        $confirmPass = $request->input('cpass');

        // Validasi password
        if ($oldPass && $oldPass != sha1('')) {
            if ($oldPass != $prev_pass) {
                $message[] = 'Old password not matched!';
            } elseif ($newPass != $confirmPass) {
                $message[] = 'Confirm password not matched!';
            } else {
                // Update password
                if ($newPass && $newPass != sha1('')) {
                    $user->password = sha1($newPass);
                    $message[] = 'Password updated successfully!';
                } else {
                    $message[] = 'Please enter a new password!';
                }
            }
        }

        $user->save(); // Simpan perubahan pada model User

        return redirect()->back()->with('message', $message); // Kembalikan ke halaman sebelumnya dengan pesan
    }


    public function game()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('game', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function tictac()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.tictac', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function cardlv1()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.cardlv1', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function batu()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.batu', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function ular()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.ular', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function gambar()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.gambar', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }

    public function ninja()
    {
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId); // Temukan pengguna berdasarkan ID
        $userName = $user->name; // Ambil nama pengguna
        $userImage = $user->image;
        return view('games.ninja', [
            "title" => "Game",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);
    }
}
