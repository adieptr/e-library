<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Models\Content;
use App\Models\Dtluser;
use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Validator;

class CourceController extends Controller
{
    public function index()
    {
        $post = Playlist::with('tutor')->where("status", "active")->get();
        $post->makeHidden(['date']);
        return new DataResource(true, "List Kursus", $post);
    }

    protected function detailsCource($id)
    {
        $post = Playlist::with('tutor')->where("id", $id)->first();
        if ($post) {
            $post->makeHidden(["tutor_id", 'date', 'jenis', 'tingkatan', "status"]);
            $post->tutor->makeHidden(["id", 'email', 'password', 'role']);
            return new DataResource(true, "Detail Cource", $post);
        } else {
            return new DataResource(false, "Cource not found", null);
        }
    }

    protected function searchCource(Request $request)
    {
        $search = $request->input("search");
        $data = Playlist::with('tutor')
            ->where("title", "LIKE", "%$search%")
            ->orWhere("harga", "LIKE", "%$search%")
            ->orWhere('jenis', "LIKE", "%$search%")
            ->orWhere("tingkatan", "LIKE", "%$search%")->get();
        $data->makeHidden(["tutor_id", 'date', 'jenis', 'tingkatan', "status"]);
        return new DataResource($data->isNotEmpty(), $data->isNotEmpty() ? "Data ditemukan" : "Data Tidak Di Temukan", $data);
    }
    protected function materiContent(Request $request)
    {
        $input = $request->input("cource_id");
        $post = Content::where("playlist_id", $input)->where("status", "active")->get();
        $post->makeHidden(["tutor_id", 'playlist_id', 'description', 'video', 'thumb', 'date']);
        return new DataResource(true, "List Content", $post);
    }
    protected function detailKelas(Request $request)
{
    $input = $request->input("id_user");
    $post = Dtluser::with("playlist")->where("id_user", $input)->get();
    $playlists = $post->map(function ($dtlUser) {
        return [
            'playlist_id' => $dtlUser->playlist->id,
            'playlist_title' => $dtlUser->playlist->title,
        ];
    });

    // Print data to make sure it's correct
    Log::info($playlists);

    return new DataResource(true, "List Class", $playlists);
}

}
