<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutors;
use App\Models\Content;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CoursesadController extends Controller
{
    public function index()
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('tutor_id');

        // Periksa apakah ID tutor tersedia
        if ($tutor_id) {
            // Temukan pengguna berdasarkan ID
            $user = Tutors::find($tutor_id);

            // Periksa apakah pengguna ditemukan
            if ($user) {
                // Ambil data pengguna
                $userName = $user->name;
                $userImage = $user->image;
                $userProfesi = $user->profession;

                // Ambil semua playlist (kursus) yang dibuat oleh tutor dengan tutor_id yang sama dengan yang ada di cookie
                $playlists = Playlist::where('tutor_id', $tutor_id)->orderBy('date', 'DESC')->paginate(5);

                // Kirim data playlist ke tampilan
                return view('coursesad', compact('playlists', 'userName', 'userImage', 'userProfesi'), [
                    "totalPages" => $playlists->lastPage(),
                    "currentPage" => $playlists->currentPage()
                ]);
            } else {
                // Jika pengguna tidak ditemukan, tampilkan pesan error
                $errorMessage = "User not found!";
                return view('coursesad', compact('errorMessage'));
            }
        } else {
            // Jika ID tutor tidak tersedia, tampilkan pesan error
            $errorMessage = "Tutor ID not found!";
            return view('coursesad', compact('errorMessage'));
        }
    }


    public function cariplayad(Request $request)
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('tutor_id');

        // Periksa apakah ID tutor tersedia
        if ($tutor_id) {
            // Temukan pengguna berdasarkan ID
            $user = Tutors::find($tutor_id);

            // Periksa apakah pengguna ditemukan
            if ($user) {
                // Ambil data pengguna
                $userName = $user->name;
                $userImage = $user->image;
                $userProfesi = $user->profession;

                // Lakukan pencarian jika terdapat input pencarian
                if ($request->has('search')) {
                    $keyword = $request->input('search');
                    // Ambil semua playlist (kursus) yang dibuat oleh tutor dengan tutor_id yang sama dengan yang ada di cookie
                    $playlists = Playlist::where('tutor_id', $tutor_id)
                        ->where(function ($query) use ($keyword) {
                            $query->where('title', 'LIKE', "%$keyword%")
                                ->orWhere('description', 'LIKE', "%$keyword%");
                        })
                        ->orderBy('date', 'DESC')
                        ->paginate(5);
                } else {
                    // Ambil semua playlist (kursus) jika tidak ada pencarian
                    $playlists = Playlist::where('tutor_id', $tutor_id)->orderBy('date', 'DESC')->paginate(5);
                }

                // Kirim data playlist ke tampilan
                return view('coursesad', compact('playlists', 'userName', 'userImage', 'userProfesi'),[
                    "totalPages" => $playlists->lastPage(),
                    "currentPage" => $playlists->currentPage()
                ]);
            } else {
                // Jika pengguna tidak ditemukan, tampilkan pesan error
                $errorMessage = "User not found!";
                return view('coursesad', compact('errorMessage'));
            }
        } else {
            // Jika ID tutor tidak tersedia, tampilkan pesan error
            $errorMessage = "Tutor ID not found!";
            return view('coursesad', compact('errorMessage'));
        }
    }





    public function addCourses()
    {
        $tutor_id = Cookie::get('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;
        // Tampilkan view untuk menambahkan course
        return view('add_courses', [
            "title" => "Tambah Content",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
        ]);
    }

    public function addPlaylist(Request $request)
    {
        // Ambil tutor_id dari cookie
        $tutor_id = Cookie::get('tutor_id');

        // Validasi form
        $request->validate([
            'status' => 'required',
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
            'image' => 'required',
            'harga' => 'required|max:20',
            'tingkatan' => 'required',
            'jenis' => 'required'
        ]);

        // Ambil data dari form
        $status = $request->status;
        $title = $request->title;
        $description = $request->description;
        $harga = $request->harga;
        $tingkatan = $request->tingkatan;
        $jenis = $request->jenis;
        // Proses upload gambar
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploaded_files'), $imageName);
        $id = uniqid();
        $date = now()->format('Y-m-d');
        // Simpan data playlist ke database
        $playlist = new Playlist();
        $playlist->id = $id;
        $playlist->tutor_id = $tutor_id;
        $playlist->status = $status;
        $playlist->title = $title;
        $playlist->description = $description;
        $playlist->thumb = $imageName;
        $playlist->date = $date;
        $playlist->harga = $harga;
        $playlist->tingkatan = $tingkatan;
        $playlist->jenis = $jenis;
        $playlist->save();

        // Redirect ke halaman coursesad dengan pesan sukses
        return redirect()->route('coursesad.index')->with('success', 'Kursus Berhasil Di Tambahkan');
    }

    public function deletePlaylist(Request $request)
    {
        // Validasi request
        $request->validate([
            'playlist_id' => 'required',
        ]);

        // Ambil ID playlist dari request
        $playlistId = $request->playlist_id;

        // Hapus playlist beserta lagu-lagunya
        DB::transaction(function () use ($playlistId) {
            // Hapus playlist
            Playlist::where('id', $playlistId)->delete();

            // Hapus lagu-lagu yang terhubung dengan playlist tersebut
            Content::where('playlist_id', $playlistId)->delete();
        });

        // Redirect kembali ke halaman coursesad dengan pesan sukses
        return redirect()->back()->with('success', 'Kursus Berhasil Di Hapus!');
    }



    public function updatePlaylistView($get_id)
    {
        $tutor_id = Cookie::get('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Anda perlu mendapatkan data playlist berdasarkan $get_id di sini
        $playlist = Playlist::find($get_id);

        // Pastikan playlist ditemukan
        if (!$playlist) {
            return redirect()->back()->with('error', 'Kursus tidak ditemukan!');
        }

        // Kumpulkan semua data yang ingin Anda kirimkan ke view dalam satu array
        $data = [
            "title" => "Update Content",
            "userName" => $userName,
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "playlist" => $playlist, // Mengirimkan data playlist
        ];

        // Kirimkan data ke view update_playlist
        return view('update_playlist', $data);
    }


    // Fungsi untuk memperbarui playlist
    public function updatePlaylist(Request $request)
    {
        // Validasi form
        try {
            // Validasi form
            $request->validate([
                'get_id' => 'required',
                'status' => 'required',
                'title' => 'required|max:100',
                'description' => 'required|max:1000',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'tingkatan' => 'required',
                'jenis' => 'required',
                'harga' => 'required|max:20',

            ]);

            // Ambil data dari form
            $get_id = $request->get_id;
            $status = $request->status;
            $title = $request->title;
            $description = $request->description;
            $harga = $request->harga;
            $tingkatan = $request->tingkatan;
            $jenis = $request->jenis;
            // Perbarui data playlist berdasarkan ID yang diberikan
            $playlist = Playlist::find($get_id);
            $playlist->status = $status;
            $playlist->title = $title;
            $playlist->description = $description;
            $playlist->tingkatan = $tingkatan;
            $playlist->jenis = $jenis;
            // Periksa apakah ada gambar yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                Storage::delete('public/uploaded_files/' . $playlist->thumb);

                // Upload gambar baru
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploaded_files'), $imageName);
                $playlist->thumb = $imageName;
            }
            $playlist->harga = $harga;


            // Simpan perubahan playlist ke database
            $playlist->save();

            // Tambahkan log
            Log::info('Kursus berhasil diperbarui', [
                'playlist_id' => $playlist->id,
                'title' => $playlist->title,
                'status' => $playlist->status,
                'description' => $playlist->description,
                'harga' => $playlist->harga,
                'tingkatan' => $playlist->tingkatan,
                'jenis' => $playlist->jenis
            ]);

            // Redirect kembali ke halaman update_playlist dengan pesan sukses
            return redirect()->route('coursesad.index')->with('success', 'Kursus Berhasil Di Perbarui');
        } catch (\Exception $e) {
            // Tambahkan log jika terjadi kesalahan
            Log::error('Gagal Memperbarui Kursus', [
                'error' => $e->getMessage()
            ]);

            // Redirect kembali ke halaman update_playlist dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi');
        }
    }
}
