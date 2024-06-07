<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Likes;
use App\Models\Tutors;
use App\Models\Content;
use App\Models\Bookmark;
use App\Models\Comments;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class SiswassssController extends Controller
{
    public function index($id)
    {
        $tutorsId = Cookie::get('sp_id'); // Ambil ID pengguna dari cookie
        $tutors = Tutors::find($tutorsId); // Temukan pengguna berdasarkan ID
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image;
        $userProfesi = $tutors->profession;

        $tutor = Tutors::find($id);
        $videos = User::where('tutor_id', $tutor->id)->get();
        return view('detailsiswa', compact('videos', 'tutor', 'userName', 'userImage', 'userProfesi'));
    }


    public function carisiswadalam(Request $request, $id)
{
    $tutorsId = Cookie::get('sp_id'); // Ambil ID pengguna dari cookie
    $tutors = Tutors::find($tutorsId); // Temukan pengguna berdasarkan ID
    $userName = $tutors->name; // Ambil nama pengguna
    $userImage = $tutors->image;
    $userProfesi = $tutors->profession;

    $tutor = Tutors::find($id);
    $videos = User::where('tutor_id', $tutor->id);

    // Lakukan pencarian jika terdapat input pencarian
    if ($request->has('search')) {
        $keyword = $request->input('search');
        $videos->where('name', 'like', '%' . $keyword . '%');
    }

    // Ambil data video sesuai dengan kriteria pencarian
    $videos = $videos->get();

    return view('detailsiswa', compact('videos', 'tutor', 'userName', 'userImage', 'userProfesi'));
}




    public function showPlaylistad(Request $request, $playlistId)
    {
        // Ambil data playlist berdasarkan ID
        $tutor = Tutors::where('id', $playlistId)
            ->first();

        // Periksa jika playlist ditemukan
        if ($tutor) {
            // // Lakukan operasi untuk menambah atau menghapus bookmark playlist
            // $user_id = $request->cookie('sp_id');
            // $bookmark = Bookmark::where('user_id', $user_id)
            //     ->where('playlist_id', $playlistId)
            //     ->exists();

            // // Jika user telah bookmark playlist, tandai sebagai sudah disimpan
            // $isSaved = $bookmark ? true : false;

            // Assign videos jika playlist ditemukan
            // $videos = $playlist->videos;
            $videos = User::where('tutor_id', $tutor->id)
                         ->get();
                        //  dd(DB::getQueryLog());

            // Mengambil data tutor yang terkait dengan playlist
            // $tutor = Tutors::find($playlist->tutor_id);

            // Mengambil informasi pengguna dari cookie
            $tutorsId = Cookie::get('sp_id');
            $tutors = Tutors::find($tutorsId);
            $userName = $tutors->name;
            $userImage = $tutors->image;
            $userProfesi = $tutors->profession;

            // Tampilkan view playlist dengan data yang diperlukan
            return view('detailsiswa', compact('videos', 'tutor', 'userName', 'userImage', 'userProfesi'));
        } else {
            // Jika playlist tidak ditemukan, tampilkan pesan error
            return view('playlist_not_found');
        }
    }


//     public function updateContentForm($videoId)
// {
//     $tutorId = Cookie::get('tutor_id');
//     $tutors = Tutors::find($tutorId);
//         $userName = $tutors->name; // Ambil nama pengguna
//         $userImage = $tutors->image; // Ambil URL gambar profil pengguna
//         $userProfesi = $tutors->profession;
//     if (!$tutorId) {
//         return redirect()->route('logreg'); // Redirect to login if tutor_id is not set
//     }

//     $content = Content::where('id', $videoId)
//         ->where('tutor_id', $tutorId)
//         ->first();

//     if (!$content) {
//         return redirect()->route('contentad')->with('error', 'Video not found!');
//     }

//     // Load the playlists associated with the tutor
//     $playlists = Playlist::where('tutor_id', $tutorId)->get();

//     // Render the update content form view with the $content data and playlists
//     return view('update_content', compact('content', 'playlists'), [
//         "title" => "Content Admin",
//         "userName" => $userName, // Teruskan nama pengguna ke tampilan
//         "userImage" => $userImage,
//         "userProfesi" => $userProfesi
//          // Teruskan URL gambar profil pengguna ke tampilan
//     ]);
// }


// public function updateContent(Request $request, $videoId)
// {
//     // Validation rules
//     $request->validate([
//         'status' => 'required',
//         'title' => 'required|max:100',
//         'description' => 'required|max:1000',
//         'playlist' => 'required',
//     ]);

//     try {
//         // Find the content by ID
//         $content = Content::findOrFail($videoId);

//         // Update content properties
//         $content->status = $request->status;
//         $content->title = $request->title;
//         $content->description = $request->description;
//         $content->playlist_id = $request->playlist;

//         // Check if thumbnail is uploaded
//         if ($request->hasFile('thumb')) {
//             $thumbName = time() . '.' . $request->thumb->extension();
//             $request->thumb->move(public_path('uploaded_files'), $thumbName);
//             $content->thumb = $thumbName;
//         } elseif (!$request->hasFile('thumb') && $content->thumb) {
//             // If thumbnail is not uploaded and there is an existing thumbnail, keep the existing one
//             $thumbName = $content->thumb;
//         }

//         // Check if video is uploaded
//         if ($request->hasFile('video')) {
//             $videoName = time() . '.' . $request->video->extension();
//             $request->video->move(public_path('uploaded_files'), $videoName);
//             $content->video = $videoName;
//         } elseif (!$request->hasFile('video') && $content->video) {
//             // If video is not uploaded and there is an existing video, keep the existing one
//             $videoName = $content->video;
//         }

//         // Save the updated content
//         $content->save();

//         return redirect()->route('contentad')->with('success', 'Content updated successfully!');
//     } catch (\Exception $e) {
//         Log::error('Failed to update content: ' . $e->getMessage());
//         return redirect()->back()->with('error', 'Failed to update content: ' . $e->getMessage());
//     }
// }

// public function delete(Request $request)
// {
//     $delete_id = $request->input('video_id');
//     $content = Content::find($delete_id);

//     if ($content) {
//         // 1. Hapus semua likes yang terkait dengan content yang akan dihapus
//         Likes::where('content_id', $delete_id)->delete();

//         // 2. Hapus semua comments yang terkait dengan content yang akan dihapus
//         Comments::where('content_id', $delete_id)->delete();

//         // 3. Hapus content itu sendiri
//         unlink(public_path('uploaded_files/'.$content->thumb));
//         unlink(public_path('uploaded_files/'.$content->video));
//         $content->delete();

//         $message = 'Video deleted!';
//     } else {
//         $message = 'Video already deleted!';
//     }

//     return redirect()->back()->with('message', $message);
// }
}
