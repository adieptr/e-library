<?php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import class Hash
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    public function index()
    {
        return view('logreg');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [
                'image.max' => 'Ukuran gambar terlalu besar. Maksimum 2MB.'
            ]);

            $id = substr(Str::uuid(), 0, 20);
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploaded_files'), $imageName);

            $user = User::create([
                'id' => $id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // Gunakan Hash::make() untuk meng-hash password
                'image' => $imageName
            ]);

            if ($user) {
                return redirect('/logreg')->with('success', 'Akun berhasil dibuat. Silakan login.');
            } else {
                return redirect()->back()->with('error', 'Gagal membuat akun pengguna.');
            }
        }

        // return view('auth.logreg');
    }


    public function edit()
    {
        // Ambil ID pengguna dari cookie
        $userId = Cookie::get('user_id');

        // Temukan data pasien berdasarkan ID pengguna
        $data = User::where('id', $userId)->first();

        // Jika data tidak ditemukan, berikan pesan atau tindakan yang sesuai

        // Kirim data ke tampilan editpasien.blade.php
        $userImage = $data->image;
        $userName = $data->name;
        return view('updateprofileu', compact('data'), [
            "title" => "Profile User",
            "userName" => $userName,
            "userImage" => $userImage,
            "userId" => $userId
        ]);

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

        return redirect()->route('pages.profileuser')->with('success', 'Berhasil Memperbarui Profil!');// Kembalikan ke halaman sebelumnya dengan pesan
    }
}


