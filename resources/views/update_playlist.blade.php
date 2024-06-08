@extends('components.adminheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}


<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardad') }}" class="logo">Tutor</a>



        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>

        <div class="profile">

            <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
            <h3>{{ $userName }}</h3>
            <span>{{ $userProfesi }}</span>
            <a href="{{ url('/profileadmin') }}" class="btn">view profile</a>

            <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">logout</a>

        </div>

    </section>

</header>




<section class="playlist-form">
    <h1 class="heading">Update Kursus</h1>

    <form action="{{ route('update_playlist') }}" method="post" enctype="multipart/form-data" id="formup">
        @csrf <!-- Tambahkan CSRF token untuk keamanan form -->

        <!-- Input tersembunyi untuk menyimpan ID playlist -->
        <input type="hidden" name="get_id" value="{{ $playlist->id }}">

        <p>Status Kursus <span>*</span></p>
        <select name="status" class="box" required>
            <option value="{{ $playlist->status }}" selected>{{ $playlist->status }}</option>
            <option value="active">Aktif</option>
            <option value="deactive">Nonaktif</option>
        </select>

        <p>Judul Kursus <span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Enter playlist title" value="{{ $playlist->title }}" class="box">

        <p>Deskripsi Kursus <span>*</span></p>
        <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10">{{ $playlist->description }}</textarea>

        <p>Unggah Foto Kursus <span>*</span></p>
        <div class="thumb">
            <img src="../uploaded_files/{{ $playlist->thumb }}" alt="Playlist Thumbnail">
        </div>
        <input type="file" name="image" accept="image/*" class="box" id="image">
        <small id="image-error" style="display: none; font-size: 1.7rem; color: #888; text-align: center;">Ukuran gambar terlalu besar maksimal 2MB</small>

        <p>Tingkatan Kursus <span>*</span></p>
        <select name="tingkatan" class="box" required>
           <option value="{{ $playlist->tingkatan }}" selected disabled>{{ $playlist->tingkatan }}</option>
           <option value="beginer">Pemula</option>
           <option value="intermiadtel">Menengah</option>
           <option value="advenced">Tingkat Lanjut</option>
        </select>

        <p>Jenis Kursus <span>*</span></p>
        <select name="jenis" class="box" required>
           <option value="{{ $playlist->jenis }}" selected disabled>{{ $playlist->jenis }}</option>
           <option value="Pemrograman">Pemrograman</option>
           <option value="Ui/Ux">UI/UX</option>
           <option value="Umum">Lainnya</option>
        </select>

        <p>Harga <span>*</span></p>
        <input type="number" name="harga" maxlength="100" required placeholder="Rp..." value="{{ $playlist->harga }}" class="box">

        <input type="submit" value="Update Kursus" name="submit" class="btn">
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
