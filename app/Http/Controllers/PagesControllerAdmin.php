<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutors;
use App\Models\Content;
use App\Models\Comments;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Dtluser;

class PagesControllerAdmin extends Controller
{
    public function index()
    {
        $tutorsId = Cookie::get('tutor_id');

        $tutors = Tutors::find($tutorsId); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        return view('components.adminheader', [
            "title" => "Dashboard Admin",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }

    public function dashboard()
    {
        // Ambil ID tutor dari cookie
        $tutorId = Cookie::get('tutor_id');

        // Temukan data tutor berdasarkan ID
        $tutor = Tutors::find($tutorId);

        // Periksa apakah ID tutor tersedia
        if ($tutor) {
            // Ambil data pengguna
            $userName = $tutor->name;
            $userImage = $tutor->image;
            $userProfesi = $tutor->profession;

            // Hitung jumlah playlist yang dimiliki oleh tutor
            $totalPlaylists = Playlist::where('tutor_id', $tutorId)->count();

            // Hitung total konten yang dimiliki oleh tutor
            $totalContents = Content::where('tutor_id', $tutorId)->count();

            // Hitung total komentar yang dimiliki oleh tutor
            $totalComments = Comments::whereIn('content_id', function ($query) use ($tutorId) {
                $query->select('id')->from('content')->where('tutor_id', $tutorId);
            })->count();

            // Hitung total pengguna yang memiliki tutor dengan ID yang sesuai
            $totalUsers = Dtluser::where('tutor_id', $tutorId)->count();

            // Ambil data siswa (user) berdasarkan id_tutor
            $siswa = User::where('tutor_id', $tutorId)->get();
            foreach ($siswa as $item) {
                $plays = Playlist::find($item->playlist_id);
                $item->playlist = $plays;
            }
            $dtlsiswa = Dtluser::where('tutor_id', $tutorId)->get();
            foreach ($dtlsiswa as $item) {
                $user = User::find($item->id_user);
                $plays = Playlist::find($item->playlist_id);
                $item->playlist = $plays;
                $item->user = $user;
            }

            // Array untuk menyimpan nama kursus (playlist) dari setiap siswa (user)
            $namaKursus = [];

            // Loop melalui setiap siswa (user)
            foreach ($siswa as $item) {
                // Cek apakah siswa memiliki id_playlist
                if ($item->id_playlist) {
                    // Cari nama kursus (playlist) berdasarkan id_playlist
                    $playlist = Playlist::find($item->id_playlist);
                    // Jika playlist ditemukan, simpan nama kursus (playlist) dalam array
                    if ($playlist) {
                        $namaKursus[$item->id] = $playlist->name;
                    } else {
                        $namaKursus[$item->id] = null;
                    }
                } else {
                    $namaKursus[$item->id] = null;
                }
            }
            return view('dashboardad', [
                "title" => "Dashboard Admin",
                "userName" => $userName,
                "userImage" => $userImage,
                "userProfesi" => $userProfesi,
                "totalPlaylists" => $totalPlaylists,
                "totalContents" => $totalContents,
                "totalComments" => $totalComments,
                "totalUsers" => $totalUsers,
                "siswa" => $siswa,
                "namaKursus" => $namaKursus,
                "dtlsiswa"=> $dtlsiswa

            ]);
        } else {
            return redirect()->route('loginnn');
        }
    }


    public function carisiswaad(Request $request)
    {

        $tutorId = Cookie::get('tutor_id');

        $tutors = Tutors::find($tutorId); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Hitung jumlah playlist yang dimiliki oleh tutor
        $totalPlaylists = Playlist::where('tutor_id', $tutorId)->count();

        // Hitung total konten yang dimiliki oleh tutor
        $totalContents = Content::where('tutor_id', $tutorId)->count();

        // Hitung total komentar yang dimiliki oleh tutor
        $totalComments = Comments::whereIn('content_id', function ($query) use ($tutorId) {
            $query->select('id')->from('content')->where('tutor_id', $tutorId);
        })->count();

        // Hitung total pengguna yang memiliki tutor dengan ID yang sesuai
        $totalUsers = User::where('tutor_id', $tutorId)->count();

        // Ambil data siswa (user) berdasarkan id_tutor
        $siswa = User::where('tutor_id', $tutorId)->get();
        foreach ($siswa as $item) {
            $plays = Playlist::find($item->playlist_id);
            $item->playlist = $plays;
        }

        // Array untuk menyimpan nama kursus (playlist) dari setiap siswa (user)
        $namaKursus = [];

        // Loop melalui setiap siswa (user)
        foreach ($siswa as $item) {
            // Cek apakah siswa memiliki id_playlist
            if ($item->id_playlist) {
                // Cari nama kursus (playlist) berdasarkan id_playlist
                $playlist = Playlist::find($item->id_playlist);
                // Jika playlist ditemukan, simpan nama kursus (playlist) dalam array
                if ($playlist) {
                    $namaKursus[$item->id] = $playlist->name;
                } else {
                    $namaKursus[$item->id] = null;
                }
            } else {
                $namaKursus[$item->id] = null;
            }
        }



        $keyword = $request->input('keyword');

        $siswa = User::where('name', 'LIKE', "%$keyword%")->get();

        return view('dashboardad', compact('siswa'), [
            "title" => "Dashboard Admin",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "totalPlaylists" => $totalPlaylists,
            "totalContents" => $totalContents,
            "totalComments" => $totalComments,
            "totalUsers" => $totalUsers,
            "siswa" => $siswa,
            "namaKursus" => $namaKursus
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }
}
