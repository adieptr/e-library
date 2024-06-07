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


class VideoController extends Controller
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
            $user_id = $request->cookie('user_id');
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

            $userId = Cookie::get('user_id'); // Ambil ID pengguna dari cookie
            $user = User::find($userId); // Temukan pengguna berdasarkan ID
            $userName = $user->name; // Ambil nama pengguna
            $userImage = $user->image;

            // Tampilkan view video dengan data yang diperlukan
            return view('watch_video', compact('content', 'tutor', 'comments', 'users') , [
                'video' => $video,
                'isLiked' => $isLiked,
                'comments' => $comments,
                "title" => "Wacth Video",
                "userName" => $userName,
                "userImage" => $userImage,
                "userId" => $userId
                // Tambahkan data lain yang diperlukan untuk ditampilkan di view
            ]);
        } else {
            // Jika video tidak ditemukan, tampilkan pesan error
            return view('video_not_found');
        }
    }


    public function storeComment(Request $request, $videoId)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'content_id' => 'required|exists:contents,id',
            'comment_box' => 'required|max:1000',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan kesalahan
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $content = Content::findOrFail($request->input('content_id'));
        // Simpan komentar ke dalam database
        $randomId = Str::random(20); // Misalnya, menghasilkan string random dengan panjang 10 karakter

        // Membuat komentar dengan menggunakan karakter random sebagai ID
        Comments::create([
            'id' => $randomId,
            'content_id' => $request->input('content_id'),
            'user_id' => $request->cookie('user_id'),
            'tutor_id' => $content->tutor_id,
            'comment' => $request->input('comment_box'),
            'date' => Carbon::now()->format('Y-m-d'),

        ]);

        // Redirect kembali ke halaman video setelah komentar disimpan
        return redirect()->route('watch.video', ['id' => $videoId])->with('success', 'Comment added successfully!');
    }



public function likeVideo(Request $request, $videoId)
{
    $userId = $request->cookie('user_id');
    $contentId = $videoId;

    // Gunakan transaksi untuk memastikan keamanan operasi
    DB::beginTransaction();

    try {
        // Cari atau buat entri like
        $like = Likes::firstOrCreate([
            'user_id' => $userId,
            'content_id' => $contentId,
        ], [
            'tutor_id' => Content::findOrFail($contentId)->tutor_id,
        ]);

        // Jika entri sudah ada, hapus like
        if ($like->wasRecentlyCreated) {
            // Redirect kembali ke halaman tonton video setelah menangani tindakan suka
            return redirect()->route('watch.video', ['id' => $videoId])->with('success', 'Like added successfully!');
        } else {
            $like->delete();
            // Redirect kembali ke halaman tonton video setelah menangani tindakan dislike
            return redirect()->route('watch.video', ['id' => $videoId])->with('success', 'Like removed successfully!');
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // Tangani kesalahan jika terjadi
        return redirect()->back()->with('error', 'An error occurred while processing your request.');
    }
}


public function editComment($videoId, $commentId)
{
    // Temukan komentar berdasarkan ID
    $comment = Comments::findOrFail($commentId);

    // Tampilkan view untuk mengedit komentar
    return view('watch_video', [
        'comment' => $comment,
        'editCommentId' => $comment->id, // Menyediakan ID komentar yang sedang diedit
        'editComment' => $comment->comment,
    ]);
}


public function updateComment(Request $request, $videoId, $commentId)
{
    // Validasi data yang diterima dari formulir
    $validator = Validator::make($request->all(), [
        'update_box' => 'required|max:1000',
    ]);

    // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan kesalahan
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Temukan komentar berdasarkan ID
    $comment = Comments::findOrFail($commentId);

    // Update komentar
    $comment->update([
        'comment' => $request->input('update_box'),
    ]);

    // Ambil data konten video berdasarkan ID
    $video = Content::findOrFail($videoId);

    // Redirect kembali ke halaman video setelah komentar diperbarui
    return redirect()->route('watch.video', ['id' => $videoId])->with('success', 'Comment updated successfully!')->with('video', $video);
}

public function deleteComment($videoId, $commentId)
{
    // Temukan komentar berdasarkan ID
    $comment = Comments::findOrFail($commentId);

    // Hapus komentar
    $comment->delete();

    // Redirect kembali ke halaman video setelah komentar dihapus
    return redirect()->route('watch.video', ['id' => $videoId])->with('success', 'Comment deleted successfully!');
}



}
