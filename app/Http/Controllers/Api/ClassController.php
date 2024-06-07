<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Models\Dtluser;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    protected function index($id) {
        $post = Dtluser::all()->where("id_user",$id);
        $post->makeHidden(['updated_at','created_at']);
        return new DataResource(true,"Data Kelas",$post);
    }
}
