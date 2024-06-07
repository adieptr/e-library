<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutors;
use App\Models\Content;
use App\Models\Bookmark;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class PlaylistController extends Controller
{
    public function index($id)
    {
        $tutorsId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $tutors = User::find($tutorsId); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image;
        $userProfesi = $tutors->profession;

        // Ambil playlist berdasarkan ID
        $playlist = Playlist::find($id);

        // Ambil semua konten (videos) terkait dengan playlist
        $videos = Content::where('playlist_id', $playlist->id)
                         ->where('status', 'active')
                         ->orderByDesc('date')
                         ->get();
                         dd(DB::getQueryLog());
        // Mengambil data tutor yang terkait dengan playlist
        $tutor = Tutors::find($playlist->tutor_id);

        return view('playlist', compact('playlist', 'videos', 'tutor', 'userName', 'userImage', 'userProfesi'));
    }



    public function showPlaylist(Request $request, $playlistId)
    {
        // Ambil data playlist berdasarkan ID
        $playlist = Playlist::where('id', $playlistId)
            ->where('status', 'active')
            ->first();

        // Periksa jika playlist ditemukan
        if ($playlist) {
            // Lakukan operasi untuk menambah atau menghapus bookmark playlist
            $user_id = $request->cookie('user_id');
            $bookmark = Bookmark::where('user_id', $user_id)
                ->where('playlist_id', $playlistId)
                ->exists();

            // Jika user telah bookmark playlist, tandai sebagai sudah disimpan
            $isSaved = $bookmark ? true : false;

            // Assign videos jika playlist ditemukan
            // $videos = $playlist->videos;
            $videos = Content::where('playlist_id', $playlist->id)
                         ->where('status', 'active')
                         ->orderByDesc('date')
                         ->get();
                        //  dd(DB::getQueryLog());

            // Mengambil data tutor yang terkait dengan playlist
            $tutor = Tutors::find($playlist->tutor_id);

            // Mengambil informasi pengguna dari cookie
            $tutorsId = Cookie::get('user_id');
            $tutors = User::find($tutorsId);
            $userName = $tutors->name;
            $userImage = $tutors->image;
            $userProfesi = $tutors->profession;

            // Tampilkan view playlist dengan data yang diperlukan
            return view('playlist', compact('playlist', 'videos', 'tutor', 'isSaved', 'userName', 'userImage', 'userProfesi'));
        } else {
            // Jika playlist tidak ditemukan, tampilkan pesan error
            return view('playlist_not_found');
        }
    }
}
