@extends('components.userheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
<script src="{{ asset('assets/js/user_script.js') }}"></script>
<section class="form-container" style="min-height: calc(100vh - 19rem);">

    <form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data" id="formup">
        @csrf
        @method('put')
       <h3>Update Profile</h3>
       <div class="flex">
          <div class="col">
             <p>Nama Lengkap :</p>
             <input type="text" name="name" placeholder="{{ $data->name }}" maxlength="100" class="box">
             <p>Alamat Email :</p>
             <input type="email" name="email" placeholder="{{ $data->email }}" maxlength="100" class="box">
             <p>Unggah Foto Profil :</p>
             <input type="file" name="image" accept="image/*" class="box" id="image">
             <small id="image-error" style="display: none; font-size: 1.7rem; color: #888; text-align: center;">Ukuran gambar terlalu besar maksimal 2MB</small>
          </div>
          {{-- <div class="col">
                <p>old password</p>
                <input type="password" name="old_pass" placeholder="enter your old password" maxlength="50" class="box">
                <p>new password</p>
                <input type="password" name="new_pass" placeholder="enter your new password" maxlength="50" class="box">
                <p>confirm password</p>
                <input type="password" name="cpass" placeholder="confirm your new password" maxlength="50" class="box">
          </div> --}}
       </div>
       <input type="submit" name="submit" value="update profile" class="btn">
    </form>

 </section>
 <script>
    const form = document.getElementById('formup');
    const imageField = document.getElementById('image');
    const imageError = document.getElementById('image-error');

    form.addEventListener('submit', function(event) {
        if (imageField.files[0].size > 2048 * 1024) {
            event.preventDefault();
            imageError.style.display = 'block';
        } else {
            imageError.style.display = 'none';
        }
    });
</script>
@endsection
