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

class ContentadController extends Controller
{
    public function index()
    {
        $tutor_id = Cookie::get('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        if (!$tutor_id) {
            return redirect()->route('logreg'); // Redirect to login if tutor_id is not set
        }

        $contents = Content::where('tutor_id', $tutor_id)->orderBy('date', 'DESC')->paginate(5);

        return view('contentad', compact('contents'), [
            "title" => "Content Admin",
            "userName" => $userName,
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "totalPages" => $contents->lastPage(),
            "currentPage" => $contents->currentPage()
        ]);
    }

    public function caricontentad(Request $request)
    {
        $tutor_id = Cookie::get('tutor_id');

        // Periksa apakah tutor_id tersedia
        if (!$tutor_id) {
            return redirect()->route('logreg'); // Redirect ke halaman login jika tutor_id tidak diatur
        }

        // Ambil data tutor
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name;
        $userImage = $tutors->image;
        $userProfesi = $tutors->profession;

        // Lakukan pencarian jika terdapat input pencarian
        if ($request->has('search')) {
            $keyword = $request->input('search');
            $contents = Content::where('tutor_id', $tutor_id)
                ->where('title', 'LIKE', "%$keyword%")
                ->orderBy('date', 'DESC')
                ->paginate(5);
        } else {
            $contents = Content::where('tutor_id', $tutor_id)
                ->orderBy('date', 'DESC')
                ->paginate(5);
        }

        return view('contentad', compact('contents'), [
            "title" => "Content Admin",
            "userName" => $userName,
            "userImage" => $userImage,
            "userProfesi" => $userProfesi,
            "totalPages" => $contents->lastPage(),
            "currentPage" => $contents->currentPage()
        ]);
    }

    public function delete(Request $request)
    {
        $delete_id = $request->input('video_id');
        $content = Content::find($delete_id);

        if ($content) {
            // 1. Hapus semua likes yang terkait dengan content yang akan dihapus
            $likes = Likes::where('content_id', $delete_id);

            // 2. Hapus semua comments yang terkait dengan content yang akan dihapus
            $com = Comments::where('content_id', $delete_id);

            // 3. Hapus materi itu sendiri, jika file ada
            $thumbPath = public_path('uploaded_files/' . $content->thumb);
            $videoPath = public_path('uploaded_files/' . $content->video);

            if (file_exists($thumbPath) && file_exists($videoPath)) {
                unlink($thumbPath);
                unlink($videoPath);
            } else {
                $content->delete();
                $likes->delete();
                $com->delete();
            }

            // $content->delete();

            $message = 'Video deleted!';
        } else {
            $message = 'Video already deleted!';
        }

        return redirect()->back()->with('message', $message);
    }


    public function showAddContentForm()
    {
        $tutor_id = Cookie::get('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;
        if (!$tutor_id) {
            return redirect()->route('login'); // Redirect to login if tutor_id is not set
        }

        $playlists = Playlist::where('tutor_id', $tutor_id)->get();

        return view('add_content', [
            'playlists' => $playlists,
            "title" => "Tambah Content",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi
        ]);
    }

    public function uploadContent(Request $request)
    {
        $tutor_id = Cookie::get('tutor_id');
        if (!$tutor_id) {
            return redirect()->route('login'); // Redirect ke halaman login jika tutor_id tidak diatur
        }

        $request->validate([
            'status' => 'required',
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
            'playlist' => 'required', // Validasi bahwa playlist harus dipilih
            'thumb' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'file|mimes:mp4,mov,avi', // Tambahkan validasi untuk jenis file video yang diizinkan
        ]);

        try {
            // Log untuk memeriksa data dari request
            Log::info('Uploaded Content Request Data: ', $request->all());

            $id = uniqid();
            $status = $request->input('status');
            $title = $request->input('title');
            $description = $request->input('description');
            $playlist_id = $request->input('playlist'); // Ambil playlist_id dari form

            // Inisialisasi variabel thumbName dan videoName
            $thumbName = null;
            $videoName = null;

            // Upload thumbnail jika ada
            if ($request->hasFile('thumb')) {
                $thumb = $request->file('thumb');
                $thumbName = time() . '.' . $thumb->extension();
                $thumb->move(public_path('uploaded_files'), $thumbName);
            }

            // Upload video jika ada
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = time() . '.' . $video->extension();
                $video->move(public_path('uploaded_files'), $videoName);
            }

            $date = now()->format('Y-m-d');

            // Log untuk memeriksa nilai dari $date

            Content::create([
                'id' => $id,
                'tutor_id' => $tutor_id,
                'playlist_id' => $playlist_id,
                'title' => $title,
                'description' => $description,
                'thumb' => $thumbName,
                'video' => $videoName,
                'status' => $status,
                'date' => $date,
            ]);

            // Jika sampai sini tanpa exception, artinya data berhasil disimpan
            return redirect()->route('contentad.index')->with('success', 'Materi Berhasil Di Tambahkan');
        } catch (\Exception $e) {
            // Tangani kesalahan
            Log::error('Failed to upload content: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Materi Gagal Di Tambahkan' . $e->getMessage());
        }
    }


    public function updateContentForm($videoId)
    {
        $tutorId = Cookie::get('tutor_id');
        $tutors = Tutors::find($tutorId);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;
        if (!$tutorId) {
            return redirect()->route('logreg'); // Redirect to login if tutor_id is not set
        }

        $content = Content::where('id', $videoId)
            ->where('tutor_id', $tutorId)
            ->first();

        if (!$content) {
            return redirect()->route('contentad')->with('error', 'Video not found!');
        }

        // Load the playlists associated with the tutor
        $playlists = Playlist::where('tutor_id', $tutorId)->get();

        // Render the update content form view with the $content data and playlists
        return view('update_content', compact('content', 'playlists'), [
            "title" => "Content Admin",
            "userName" => $userName, // Teruskan nama pengguna ke tampilan
            "userImage" => $userImage,
            "userProfesi" => $userProfesi
            // Teruskan URL gambar profil pengguna ke tampilan
        ]);
    }


    public function updateContent(Request $request, $videoId)
    {
        // Validation rules
        $request->validate([
            'status' => 'required',
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
            'playlist' => 'required',
        ]);

        try {
            // Find the content by ID
            $content = Content::findOrFail($videoId);

            // Update content properties
            $content->status = $request->status;
            $content->title = $request->title;
            $content->description = $request->description;
            $content->playlist_id = $request->playlist;

            // Check if thumbnail is uploaded
            if ($request->hasFile('thumb')) {
                $thumbName = time() . '.' . $request->thumb->extension();
                $request->thumb->move(public_path('uploaded_files'), $thumbName);
                $content->thumb = $thumbName;
            } elseif (!$request->hasFile('thumb') && $content->thumb) {
                // If thumbnail is not uploaded and there is an existing thumbnail, keep the existing one
                $thumbName = $content->thumb;
            }

            // Check if video is uploaded
            if ($request->hasFile('video')) {
                $videoName = time() . '.' . $request->video->extension();
                $request->video->move(public_path('uploaded_files'), $videoName);
                $content->video = $videoName;
            } elseif (!$request->hasFile('video') && $content->video) {
                // If video is not uploaded and there is an existing video, keep the existing one
                $videoName = $content->video;
            }

            // Save the updated content
            $content->save();

            return redirect()->route('contentad.index')->with('sucesup', 'Materi Berhasil Di Perbarui!');
        } catch (\Exception $e) {
            Log::error('Failed to update content: ' . $e->getMessage());
            return redirect()->back()->with('errorup', 'Materi Gagal Di Perbarui!: ' . $e->getMessage());
        }
    }

    public function commentsAd()
    {
        // Ambil tutor_id dari cookie
        $tutor_id = request()->cookie('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Periksa apakah tutor_id tersedia
        if ($tutor_id) {
            // Dapatkan semua komentar yang terkait dengan tutor_id tersebut
            $comments = Comments::where('tutor_id', $tutor_id)->orderBy('date', 'DESC')->paginate(10);
            $playlist = Playlist::where('id' . $comments);

            // Ambil nama pengguna untuk setiap komentar
            foreach ($comments as $comment) {
                $comment->user_name = User::find($comment->user_id)->name;
                $comment->materi_name = Content::find($comment->content_id)->title;
            }

            // Kirim data komentar ke view
            return view('commentsad', compact('comments'), [
                'tutor_id' => $tutor_id,
                "title" => "Comments",
                "userName" => $userName, // Teruskan nama pengguna ke tampilan
                "userImage" => $userImage,
                "userProfesi" => $userProfesi,
                "totalPages" => $comments->lastPage(),
                "currentPage" => $comments->currentPage()
            ]);
        } else {
            // Redirect ke halaman login jika tutor_id tidak tersedia di cookie
            return redirect()->route('logreg');
        }
    }



    public function caricommentsad(Request $request)
    {
        // Ambil keyword pencarian dari input form
        $keyword = $request->input('search');

        // Ambil tutor_id dari cookie
        $tutor_id = request()->cookie('tutor_id');
        $tutors = Tutors::find($tutor_id);
        $userName = $tutors->name; // Ambil nama pengguna
        $userImage = $tutors->image; // Ambil URL gambar profil pengguna
        $userProfesi = $tutors->profession;

        // Periksa apakah tutor_id tersedia
        if ($tutor_id) {
            // Lakukan pencarian komentar berdasarkan keyword
            $comments = Comments::where('tutor_id', $tutor_id)
                ->where(function ($query) use ($keyword) {
                    $query->where('user_id', 'LIKE', "%$keyword%")
                        ->orWhere('comment', 'LIKE', "%$keyword%");
                })
                ->orderBy('date', 'DESC')
                ->paginate(10);

            // Ambil nama pengguna untuk setiap komentar
            foreach ($comments as $comment) {
                $comment->user_name = User::find($comment->user_id)->name;
            }

            // Kirim data komentar hasil pencarian ke view
            return view('commentsad', compact('comments'), [
                'tutor_id' => $tutor_id,
                "title" => "Comments",
                "userName" => $userName, // Teruskan nama pengguna ke tampilan
                "userImage" => $userImage,
                "userProfesi" => $userProfesi,
                "totalPages" => $comments->lastPage(),
                "currentPage" => $comments->currentPage()
            ]);
        } else {
            // Redirect ke halaman login jika tutor_id tidak tersedia di cookie
            return redirect()->route('logreg');
        }
    }





    public function deleteComment(Request $request)
    {
        $delete_id = $request->comment_id;

        $comment = Comments::find($delete_id);
        if (!$comment) {
            return redirect()->back()->with('error', 'Komentar tidak ditemukan!');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus komentar!');
    }


    public function lihatcoment(Request $request, $comentid)
    {
        // Ambil komentar berdasarkan ID
        $comment = Comments::find($comentid);

        if ($comment) {
            $videoId = $comment->content_id;

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
                return view('watch_videoad', compact('content', 'tutor', 'comments', 'users'), [
                    'video' => $video,
                    'isLiked' => $isLiked,
                    'comments' => $comments,
                    "title" => "Watch Video",
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
        } else {
            // Jika komentar tidak ditemukan, tampilkan pesan error
            return view('Komentar tidak ditemukan!');
        }
    }
}
