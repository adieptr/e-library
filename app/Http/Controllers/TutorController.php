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
use App\Models\Transaksi;
use App\Models\Dtluser;
use Illuminate\Support\Facades\Log;

class TutorController extends Controller
{
    public function index()
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('sp_id');
        $tutors = Tutors::find($tutor_id); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;
        $playlists = Tutors::where('role', 'guru')->paginate(5);
        return view('viewtutor', [
            "title" => "Data Tutors",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "playlists" => $playlists,
            "totalPages" => $playlists->lastPage(),
            "currentPage" => $playlists->currentPage()
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }

    public function landtutor()
    {
        $playlists = Tutors::where('role', 'guru')->get();
        $materi = Playlist::all();
        foreach ($materi as $mat) {
            $tutor = Tutors::find($mat->tutor_id);
            $mat->tutor = $tutor;
        }

        $materibegin = Playlist::where('tingkatan', 'beginer')->get();
        foreach ($materibegin as $matbe) {
            $tutor = Tutors::find($matbe->tutor_id);
            $matbe->tutor = $tutor;
        }

        $materiin = Playlist::where('tingkatan', 'intermiadtel')->get();
        foreach ($materiin as $matin) {
            $tutor = Tutors::find($matin->tutor_id);
            $matin->tutor = $tutor;
        }

        $materiad = Playlist::where('tingkatan', 'Advenced')->get();
        foreach ($materiad as $matad) {
            $tutor = Tutors::find($matad->tutor_id);
            $matad->tutor = $tutor;
        }
        return view('index', [
            "playlists" => $playlists,
            "materi" => $materi,
            "materibegin" => $materibegin,
            "materiin" => $materiin,
            "materiad" => $materiad,
        ]);
    }


    public function detailcor($id)
    {
        $course = Playlist::find($id);
        $tutor = Tutors::find($course->tutor_id);
        $contents = Content::where('playlist_id', $id)->get();

        return view('detailcourses', [
            'course' => $course,
            'tutor' => $tutor,
            'contents' => $contents,
        ]);
    }





    public function caritutor(Request $request)
    {
        // Ambil ID tutor dari cookie
        $tutor_id = Cookie::get('sp_id');
        $tutors = Tutors::find($tutor_id); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Ambil semua tutor
        $playlists = Tutors::where('role', 'guru');

        // Lakukan pencarian jika terdapat input pencarian
        if ($request->has('search')) {
            $keyword = $request->input('search');
            $playlists->where('name', 'like', '%' . $keyword . '%');
        }

        // Ambil data tutor sesuai dengan kriteria pencarian
        $playlists = $playlists->paginate(5);

        return view('viewtutor', [
            "title" => "Data Tutors",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "playlists" => $playlists,
            "totalPages" => $playlists->lastPage(),
            "currentPage" => $playlists->currentPage()

            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }




    public function createTransaction(Request $request)
    {
        $userId = Cookie::get('user_id');
        $playlistId = $request->input('playlist_id');

        // Check if the user has an ongoing course
        $ongoingCourse = Dtluser::where('id_user', $userId)->where('status', 'ongoing')->exists();

        if ($ongoingCourse) {
            return redirect()->back()->with('error', 'Anda masih memiliki kursus yang belum selesai');
        }

        // Check if the user already has this playlist
        $existingCourse = Dtluser::where('id_user', $userId)->where('playlist_id', $playlistId)->exists();

        if ($existingCourse) {
            return redirect()->back()->with('error', 'Anda sudah memiliki kursus ini');
        }

        if ($userId && $playlistId && $request->hasFile('bukti_pembayaran')) {
            $image = $request->file('bukti_pembayaran');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploaded_files'), $imageName);

            $transaction = new Transaksi();
            $transaction->id_transaksi = bin2hex(random_bytes(10)); // Generate a random 20 character ID
            $transaction->id_user = $userId;
            $transaction->id_playlist = $playlistId;
            $transaction->tanggal = now(); // Assuming you want to store the current date
            $transaction->bukti_pembayaran = $imageName; // Save the image name

            $transaction->save();

            // Insert data into dtl_user table
            $playlist = Playlist::find($playlistId); // Retrieve the playlist to get the tutor ID
            if ($playlist) {
                $dtlUser = new Dtluser();
                $dtlUser->id_user = $userId;
                $dtlUser->tutor_id = $playlist->tutor_id;
                $dtlUser->playlist_id = $playlistId;
                $dtlUser->status = 'pending'; // Assuming you want to set a default status

                $dtlUser->save();
            }

            return redirect()->route('courses.index'); // Redirect to a success page
        } else {
            return redirect()->back()->with('error', 'Failed to create transaction');
        }
    }



    public function trans($id)
    {
        $course = Playlist::find($id);
        $tutor = Tutors::find($course->tutor_id);
        $contents = Content::where('playlist_id', $id)->get();
        $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
        $user = User::find($userId);
        if ($user) {
            return view('transaksi', [
                'course' => $course,
                'tutor' => $tutor,
                'contents' => $contents
            ]);
        } else {
            return redirect()->route('loginnn');
        }
    }


    public function tampiluptra($id_transaksi)
    {
        $tutorsId = Cookie::get('sp_id'); // Ambil ID pengguna dari cookie
        $tutors = Tutors::find($tutorsId); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image;
        $userProfesi = $tutors->profession;


        $transaksi = Transaksi::findOrFail($id_transaksi);
        $course = Playlist::find($transaksi->id_playlist);
        $siswa = User::find($transaksi->id_user);
        $dtlsiswa = Dtluser::where('id_user', $transaksi->id_user)->first();
        $transaksi->status = $dtlsiswa ? $dtlsiswa->status : 'Status Tidak Tersedia';
        return view('update_transaksi', [
            'transaksi' => $transaksi,
            'course' => $course,
            'siswa' => $siswa,
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "tutorsId" => $tutorsId,
            "dtlsiswa" => $dtlsiswa
        ]);
    }





    public function updateTransaksi(Request $request, $id_transaksi)
    {
        // Validasi data yang diterima dari form jika diperlukan
        $request->validate([
            'status' => 'required', // Validasi status
            // Mungkin ada validasi tambahan untuk bidang lainnya
        ]);

        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id_transaksi);

        // Temukan atau buat catatan detail user berdasarkan id_user
        $dtluser = Dtluser::firstOrNew(['id_user' => $transaksi->id_user, 'playlist_id' => $transaksi->id_playlist]);

        // Perbarui status di dtl_user
        $dtluser->status = $request->status;
        $dtluser->save();

        // Catat tindakan ini ke dalam log
        Log::info('Transaksi berhasil diperbarui', ['transaksi_id' => $id_transaksi, 'user_id' => $transaksi->id_user, 'playlist_id' => $transaksi->id_playlist]);

        // Redirect ke halaman yang sesuai, misalnya ke halaman detail transaksi
        return redirect()->route('pages.datatransaksi')->with('success', 'Transaksi berhasil diperbarui.');
    }
}
