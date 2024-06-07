<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            'email' => "required",
            "password" => "required|min:8",
            'image' => "required|image|mimes:png,jpg,jpeg,svg|max:2048",
        ]);
        if ($validator->fails()) {
            print($validator);
            return response()->json($validator->errors(), 422);
        }
        $id = substr(Str::uuid(), 0, 20);
        // $imageName = null;
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploaded_files'), $imageName);
        // if ($request->hasFile('image')) {

        // }
        $post = User::create([
            "id" => $id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'image' => $imageName
        ]);
        return new DataResource(true, "Telah Terdaftar", $post);
    }
    protected function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $post = User::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploaded_files'), $imageName);

            $post->makeHidden(['tutor_id', "playlist_id", 'password']);
            $post->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $imageName,
            ]);
        } else {
            $post->makeHidden(['tutor_id', "playlist_id", 'password']);
            $post->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        return new DataResource(true,"Terupdate",$post);
    }
    protected function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
            ];
            return new DataResource(true, "Berhasil Login", $data);
        } else {
            return new DataResource(false, "Gagal Login", []);
        }
    }
    protected function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = User::find($id);
        $post->update([
            'password' => Hash::make($request->password),
        ]);
        return new DataResource(true, "Password Berubah", []);
    }
    protected function showProfile(String $id)
    {
        $post = User::find($id);
        $post->makeHidden(['tutor_id', "playlist_id", 'password']);
        return new DataResource(true, "Data Profile", $post);
    }
}
