<?php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import class Hash
use App\Http\Controllers\Controller;
use App\Models\Tutors;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;

class RegadController extends Controller
{
    public function index()
    {
        return view('tambahtutor');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:50',
                'profession' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $id = substr(Str::uuid(), 0, 20);
            $role = 'guru';
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploaded_files'), $imageName);

            $user = Tutors::create([
                'id' => $id,
                'name' => $request->input('name'),
                'profession' => $request->input('profession'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // Gunakan Hash::make() untuk meng-hash password
                'image' => $imageName,
                'role' => 'guru'
            ]);

            if ($user) {
                return redirect('/tambahtutor')->with('success', 'Akun berhasil dibuat. Silakan login.');
            } else {
                return redirect()->back()->with('error', 'Gagal membuat akun pengguna.');
            }
        }

        // return view('auth.logreg');
    }


    public function edit()
    {
        // Ambil ID tutor dari cookie
        $tutorsId = Cookie::get('tutor_id');

        // Temukan data tutor berdasarkan ID
        $tutor = Tutors::find($tutorsId);

        // Jika data tidak ditemukan, berikan pesan atau tindakan yang sesuai

        // Kirim data ke tampilan editpasien.blade.php
        $userImage = $tutor->image;
        $userName = $tutor->name;
        $userProfesi = $tutor->profession;

        // Mengirim variabel $tutorId ke view
        return view('updateprofilea', [
            "title" => "Profile User",
            "userName" => $userName,
            "userImage" => $userImage,
            "tutorId" => $tutorsId,
            "userProfesi" => $userProfesi,
            "tutor" => $tutor // Memasukkan variabel $tutor ke dalam array untuk digunakan di dalam view
        ]);
    }






    public function update(Request $request)
    {
        // Ambil ID tutor dari cookie
        $tutorsId = $request->cookie('tutor_id');

        // Temukan data tutor berdasarkan ID
        $tutor = Tutors::find($tutorsId);

        // Validasi input
        $request->validate([
            'name' => 'nullable|string',
            'profession' => 'nullable|string',
            'email' => 'nullable|email|unique:tutors,email,' . $tutorsId,
            'image' => 'nullable|image|max:2000',
            'old_pass' => 'nullable|string',
            'new_pass' => 'nullable|string',
            'cpass' => 'nullable|string|same:new_pass',
        ]);

        // Proses update data tutor
        if ($request->filled('name')) {
            $tutor->name = $request->name;
        }

        if ($request->filled('profession')) {
            $tutor->profession = $request->profession;
        }

        if ($request->filled('email')) {
            $tutor->email = $request->email;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files'), $imageName);
            // Hapus gambar sebelumnya jika ada
            if (!empty($tutor->image)) {
                File::delete(public_path('uploaded_files/' . $tutor->image));
            }
            $tutor->image = $imageName;
        }

        if ($request->filled('old_pass') && $request->filled('new_pass')) {
            if (Hash::check($request->old_pass, $tutor->password)) {
                $tutor->password = Hash::make($request->new_pass);
            } else {
                return redirect()->back()->with('error', 'Incorrect old password.');
            }
        }

        // Simpan perubahan
        $tutor->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}


