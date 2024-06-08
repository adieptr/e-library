<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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
    public function update(Request $request, $id)
    {
        // Log permintaan yang masuk
        Log::info("Update profile request received", ['id' => $id, 'request' => $request->all()]);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Log::warning("Validation failed", ['errors' => $validator->errors()]);
            return response()->json($validator->errors(), 422);
        }

        // Temukan pengguna berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            Log::error("User not found", ['id' => $id]);
            return response()->json(['message' => 'User not found'], 404);
        }

        // Ambil data sebelumnya untuk kebutuhan penghapusan gambar
        $prev_image = $user->image;

        // Update name jika ada
        if ($request->has('name')) {
            $user->name = $request->input('name');
            Log::info("Name updated", ['id' => $id, 'name' => $user->name]);
        }

        // Update email jika ada
        if ($request->has('email')) {
            $user->email = $request->input('email');
            Log::info("Email updated", ['id' => $id, 'email' => $user->email]);
        }

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploaded_files'), $imageName);
            $user->image = $imageName;

            Log::info("Image uploaded", ['id' => $id, 'image' => $imageName]);

            // Hapus gambar sebelumnya jika ada
            if ($prev_image && File::exists(public_path('uploaded_files/' . $prev_image))) {
                File::delete(public_path('uploaded_files/' . $prev_image));
                Log::info("Previous image deleted", ['id' => $id, 'prev_image' => $prev_image]);
            }
        }

        // Simpan perubahan pada model User
        $user->save();

        Log::info("Profile updated successfully", ['id' => $id]);

        return response()->json(['message' => 'Profile updated successfully!', 'user' => $user], 200);
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
    protected function updatePasswordByEmail(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        // Jika validasi gagal, kembalikan respon error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();
        // Jika pengguna tidak ditemukan, kembalikan respon error
        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }
        // Perbarui kata sandi pengguna
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        // Kembalikan respon sukses
        return response()->json(['message' => 'Password berhasil diperbarui'], 200);
    }
}
