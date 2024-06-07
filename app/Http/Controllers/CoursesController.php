<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Tutors;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Dtluser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CoursesController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna dari cookie
        $userId = Cookie::get('user_id');

        // Periksa apakah ID pengguna tersedia
        if ($userId) {
            // Temukan pengguna berdasarkan ID
            $user = User::find($userId);

            // Periksa apakah pengguna ditemukan
            if ($user) {
                $userName = $user->name;
                $userImage = $user->image;
                $userProfesi = $user->profession;

                // Ambil semua playlist (kursus) dari database
                $userPlaylistIds = Dtluser::where('id_user', $userId)
                    ->where('status', 'ongoing')
                    ->pluck('playlist_id');

                // Temukan playlist berdasarkan id_playlist yang telah ditemukan
                $playlists = Playlist::whereIn('id', $userPlaylistIds)
                    ->orderBy('date', 'desc')
                    ->get();

                // Loop melalui setiap playlist untuk mendapatkan data tutor
                foreach ($playlists as $playlist) {
                    // Ambil data tutor berdasarkan ID playlist
                    $tutor = Tutors::find($playlist->tutor_id);

                    // Tambahkan data tutor ke objek playlist
                    $playlist->tutor = $tutor;
                }

                // Kirim data playlist yang sudah diperbarui ke tampilan
                return view('courses', compact('playlists'), [
                    "title" => "Playlist",
                    "userName" => $userName, // Teruskan nama pengguna ke tampilan
                    "userImage" => $userImage,
                    "userProfesi" => $userProfesi // Teruskan URL gambar profil pengguna ke tampilan
                ]);
            } else {
                // Jika pengguna tidak ditemukan, redirect ke halaman login dengan pesan error
                return redirect()->route('loginnn')->with('error', 'User tidak ditemukan. Silakan login kembali.');
            }
        } else {
            // Jika cookie tidak tersedia, redirect ke halaman login
            return redirect()->route('loginnn')->with('error', 'Silakan login terlebih dahulu.');
        }
    }



    public function riwayatkur()
    {
        // Ambil ID pengguna dari cookie
        $userId = Cookie::get('user_id');

        // Periksa apakah ID pengguna tersedia
        if ($userId) {
            // Temukan pengguna berdasarkan ID
            $user = User::find($userId);

            // Periksa apakah pengguna ditemukan
            if ($user) {
                $userName = $user->name;
                $userImage = $user->image;
                $userProfesi = $user->profession;

                // Ambil semua playlist (kursus) dari database
                $userPlaylistIds = Dtluser::where('id_user', $userId)
                    ->where('status', 'selesai')
                    ->pluck('playlist_id');

                // Temukan playlist berdasarkan id_playlist yang telah ditemukan
                $playlists = Playlist::whereIn('id', $userPlaylistIds)
                    ->orderBy('date', 'desc')
                    ->get();

                // Loop melalui setiap playlist untuk mendapatkan data tutor
                foreach ($playlists as $playlist) {
                    // Ambil data tutor berdasarkan ID playlist
                    $tutor = Tutors::find($playlist->tutor_id);

                    // Tambahkan data tutor ke objek playlist
                    $playlist->tutor = $tutor;
                }

                // Kirim data playlist yang sudah diperbarui ke tampilan
                return view('riwayatcourses', compact('playlists'), [
                    "title" => "Playlist",
                    "userName" => $userName, // Teruskan nama pengguna ke tampilan
                    "userImage" => $userImage,
                    "userProfesi" => $userProfesi // Teruskan URL gambar profil pengguna ke tampilan
                ]);
            } else {
                // Jika pengguna tidak ditemukan, redirect ke halaman login dengan pesan error
                return redirect()->route('loginnn')->with('error', 'User tidak ditemukan. Silakan login kembali.');
            }
        } else {
            // Jika cookie tidak tersedia, redirect ke halaman login
            return redirect()->route('loginnn')->with('error', 'Silakan login terlebih dahulu.');
        }
    }



    public function completeCourse(Request $request, $playlist_id)
{
    // Dapatkan ID pengguna dari cookie
    $userId = Cookie::get('user_id');

    // Periksa apakah ID pengguna tersedia
    if ($userId) {
        // Temukan catatan dtl_user
        $dtlUser = Dtluser::where('id_user', $userId)->where('playlist_id', $playlist_id)->first();

        // Periksa apakah catatan dtl_user ditemukan
        if ($dtlUser) {
            // Perbarui status menjadi 'selesai'
            $dtlUser->status = 'selesai';
            $dtlUser->save();

            // Alihkan kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Kursus telah diselesaikan');
        } else {
            // Jika catatan dtl_user tidak ditemukan, alihkan kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Kursus tidak ditemukan');
        }
    } else {
        // Jika ID pengguna tidak tersedia, alihkan ke halaman login
        return redirect()->route('loginnn')->with('error', 'Silakan login terlebih dahulu.');
    }
}




}
