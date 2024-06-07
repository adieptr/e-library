<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Likes;
use App\Models\Tutors;
use App\Models\Content;
use App\Models\Comments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


class VideoadController extends Controller
{

    public function show($id)
    {
        // Cari konten berdasarkan ID
        $content = Content::findOrFail($id);
        $tutor = Tutors::find($content->tutor_id);

        // Logika untuk menampilkan halaman detail konten
        return view('content.show', compact('content', 'tutor'));
    }




    public function showVideo(Request $request, $videoId)
    {
        // Ambil data konten video berdasarkan ID
        $video = Content::where('id', $videoId)
            ->where('status', 'active')
            ->first();


        // Periksa jika video ditemukan
        if ($video) {
            // Lakukan operasi untuk menambah atau menghapus like video
            $user_id = $request->cookie('tutor_id');
            $like = Likes::where('user_id', $user_id)
                ->where('content_id', $videoId)
                ->exists();

            // Jika user telah menyukai video, tandai sebagai sudah disukai
            $isLiked = $like ? true : false;

            // Ambil komentar yang terkait dengan video
            $comments = Comments::where('content_id', $videoId)->get();
            $content = Content::findOrFail($videoId);
            $tutor = Tutors::find($content->tutor_id);

            $userIds = $comments->pluck('user_id');
            $users = User::whereIn('id', $userIds)->get();

            $userId = Cookie::get('tutor_id'); // Ambil ID pengguna dari cookie
            $user = Tutors::find($userId); // Temukan pengguna berdasarkan ID
            $userName = $user->name; // Ambil nama pengguna
            $userImage = $user->image;
            $userProfesi = $user->profession;

            // Tampilkan view video dengan data yang diperlukan
            return view('watch_videoad', compact('content', 'tutor', 'comments', 'users') , [
                'video' => $video,
                'isLiked' => $isLiked,
                'comments' => $comments,
                "title" => "Wacth Video",
                "userName" => $userName,
                "userImage" => $userImage,
                "userId" => $userId,
                "userProfesi" => $userProfesi
                // Tambahkan data lain yang diperlukan untuk ditampilkan di view
            ]);
        } else {
            // Jika video tidak ditemukan, tampilkan pesan error
            return view('Video tidak ditemukan!');
        }
    }


//     public function commentsAd()
// {
//     // Ambil tutor_id dari cookie
//     $tutor_id = request()->cookie('tutor_id');
//     $tutors = Tutors::find($tutor_id);
//         $userName = $tutors->name; // Ambil nama pengguna
//         $userImage = $tutors->image; // Ambil URL gambar profil pengguna
//         $userProfesi = $tutors->profession;

//     // Periksa apakah tutor_id tersedia
//     if ($tutor_id) {
//         // Dapatkan semua komentar yang terkait dengan tutor_id tersebut
//         $comments = Comments::where('tutor_id', $tutor_id)->get();

//         // Ambil nama pengguna untuk setiap komentar
//         foreach ($comments as $comment) {
//             $comment->user_name = User::find($comment->user_id)->name;
//         }

//         // Kirim data komentar ke view
//         return view('commentsad', compact('comments'), [
//             'tutor_id' => $tutor_id,
//             "title" => "Comments",
//             "userName" => $userName, // Teruskan nama pengguna ke tampilan
//             "userImage" => $userImage,
//             "userProfesi" => $userProfesi
//             ]);
//     } else {
//         // Redirect ke halaman login jika tutor_id tidak tersedia di cookie
//         return redirect()->route('logreg');
//     }
// }



    public function deleteComment(Request $request)
    {
        $delete_id = $request->comment_id;

        $comment = Comments::find($delete_id);
        if (!$comment) {
            return redirect()->back()->with('error', 'Video tidak ditemukan!');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Video berhasil dihapus!');
    }


}
