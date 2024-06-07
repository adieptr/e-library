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
            <a href="{{ url('/profileadmin') }}" class="btn">View Profile</a>

            <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">Log out</a>

        </div>

    </section>

</header>


<section class="video-form">

    <h1 class="heading">Update Materi</h1>

    @if($content)
    <form action="{{ route('update.content', ['videoId' => $content->id]) }}" method="post" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="video_id" value="{{ $content->id }}">
       <input type="hidden" name="old_thumb" value="{{ $content->thumb }}">
       <input type="hidden" name="old_video" value="{{ $content->video }}">
       <p>Status Materi <span>*</span></p>
       <select name="status" class="box" required>
          <option value="{{ $content->status }}" selected>{{ $content->status }}</option>
          <option value="active">Aktif</option>
          <option value="deactive">Nonaktif</option>
       </select>
       <p>Judul Materi <span>*</span></p>
       <input type="text" name="title" maxlength="100" required placeholder="Enter video title" class="box" value="{{ $content->title }}">
       <p>Deskripsi Materi <span>*</span></p>
       <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10">{{ $content->description }}</textarea>
       <p> Sesi Kursus </p>
       <select name="playlist" class="box">
          <option value="{{ $content->playlist_id }}" selected>-- Pilih Kursus --</option>
          @foreach($playlists as $playlist)
             <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
          @endforeach
       </select>
       <img src="../uploaded_files/{{ $content->thumb }}" alt="">
       <p>Unggah Foto Materi</p>
       <input type="file" name="thumb" accept="image/*" class="box">
       <video src="../uploaded_files/{{ $content->video }}" controls></video>
       <p>Unggah Video Materi</p>
       <input type="file" name="video" accept="video/*" class="box">
       <input type="submit" value="Update" name="update" class="btn">

    </form>
    @else
    <p class="empty">Video tidak ditemukan! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">Tambah Video</a></p>
    @endif

 </section>

@endsection
