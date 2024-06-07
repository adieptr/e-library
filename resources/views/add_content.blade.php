@extends('components.adminheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
    <script src="{{ asset('assets/js/admin_script.js') }}"></script>



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
                <a href="{{ url('/profileadmin') }}" class="btn">View Profile</a>

                <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
                    class="delete-btn">Log out</a>

            </div>

        </section>

    </header>

    <section class="video-form">

        <h1 class="heading">Buat Materi</h1>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <form action="{{ route('upload_content') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>Status Materi<span>*</span></p>
            <select name="status" class="box" required>
                <option value="" selected disabled>-- Pilih status --</option>
                <option value="active">Aktif</option>
                <option value="deactive">Nonaktif</option>
            </select>
            <p>Judul Materi <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="Masukkan judul materi" class="box">
            <p>Deskripsi Materi <span>*</span></p>
            <textarea name="description" class="box" required placeholder="Masukkan deskripsi" maxlength="1000" cols="30"
                rows="10"></textarea>
            <p>Sesi Kursus <span>*</span></p>
            <select name="playlist" class="box" required>
                <option value="" disabled selected>-- Pilih Kursus --</option>
                @if (count($playlists) > 0)
                    @foreach ($playlists as $playlist)
                        <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
                    @endforeach
                @else
                    <option value="" disabled>Tidak ada materi yang dibuat!</option>
                @endif
            </select>
            <p>Unggah Foto Materi <span>*</span></p>
            <input type="file" name="thumb" accept="image/*"  class="box">
            <p>Unggah Video Materi <span>*</span></p>
            <input type="file" name="video" accept="video/*"  class="box">
            <input type="submit" value="Tambah Materi" name="submit" class="btn">
        </form>

    </section>

@endsection
