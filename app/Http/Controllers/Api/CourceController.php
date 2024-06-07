<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Http\Resources\DataResource;

class CourceController extends Controller
{
    public function index() {
        $post = Playlist::with('tutor')->where("status","active")->get();
        $post->makeHidden(['date']);
        return new DataResource(true,"List Kursus", $post);
    }

    public function detailsCource($id) {
        $post = Playlist::with('tutor')->where("id",$id)->first();
        if ($post) {
            $post->makeHidden(["tutor_id",'date','jenis','tingkatan',"status"]);
            $post->tutor->makeHidden(["id",'email','password','role']);
            return new DataResource(true,"Detail Cource", $post);
        } else {
            return new DataResource(false, "Cource not found", null);
        }
    }

    public function searchCource(Request $request) {
        $search = $request->input("search");
        $data = Playlist::with('tutor')
                        ->where("title", "LIKE", "%$search%")
                        ->orWhere("harga", "LIKE", "%$search%")
                        ->orWhere('jenis', "LIKE", "%$search%")
                        ->orWhere("tingkatan", "LIKE", "%$search%")->get();
        $data->makeHidden(["tutor_id",'date','jenis','tingkatan',"status"]);
        return new DataResource($data->isNotEmpty(), $data->isNotEmpty() ? "Data ditemukan" : "Data Tidak Di Temukan", $data);
    }
}
