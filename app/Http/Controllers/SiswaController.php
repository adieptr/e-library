<?php

namespace App\Http\Controllers;

use App\Models\Tutors;
use App\Models\Content;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Likes;
use App\Models\Comments;
use App\Models\User;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('sp_id');
        $tutors = Tutors::find($tutor_id); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;
        $contents = User::paginate(8);
        return view('viewsiswa', [
            "title" => "Data Tutors",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "contents" => $contents,
            "totalPages" => $contents->lastPage(),
            "currentPage" => $contents->currentPage()
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }

    public function carisiswa(Request $request)
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('sp_id');
        $tutors = Tutors::find($tutor_id); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Ambil semua siswa
        $contents = User::query();

        // Lakukan pencarian jika terdapat input pencarian
        if ($request->has('search')) {
            $keyword = $request->input('search');
            $contents->where('name', 'like', '%' . $keyword . '%')->paginate(5);
        }

        // Ambil data siswa sesuai dengan kriteria pencarian
        $contents = $contents->paginate(5);

        return view('viewsiswa', [
            "title" => "Data Siswa",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "contents" => $contents,
            "totalPages" => $contents->lastPage(),
            "currentPage" => $contents->currentPage()
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }
}
