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


<section class="playlist-form">
    <h1 class="heading">Buat Kursus</h1>
    <form action="{{ route('add.playlist') }}" method="post" enctype="multipart/form-data" id="formup">
       @csrf
       <p>Status Kursus<span>*</span></p>
       <select name="status" class="box" required>
          <option value="" selected disabled>-- Pilih Status --</option>
          <option value="active">Aktif</option>
          <option value="deactive">Nonaktif</option>
       </select>
       <p>Judul Kursus <span>*</span></p>
       <input type="text" name="title" maxlength="100" required placeholder="Masukkan judul kursus" class="box">
       <p>Deskripsi Kursus <span>*</span></p>
       <textarea name="description" class="box" required placeholder="Masukkan deksripsi" maxlength="1000" cols="30" rows="10"></textarea>
       <p>Foto Kursus <span>*</span></p>
       <input type="file" name="image" accept="image/*" required class="box" id="image">
       <small id="image-error" style="display: none; font-size: 1.7rem; color: #888; text-align: center;">Ukuran gambar terlalu besar maksimal 2MB</small>
       <p>Tingkatan Kursus <span>*</span></p>
       <select name="tingkatan" class="box" required>
          <option value="" selected disabled>-- Pilih Tingkatan --</option>
          <option value="beginer">Pemula</option>
          <option value="intermiadtel">Menengah</option>
          <option value="advenced">Tingkat Lanjut</option>
       </select>
       <p>Jenis Kursus <span>*</span></p>
       <select name="jenis" class="box" required>
          <option value="" selected disabled>-- Pilih Jenis Kursus --</option>
          <option value="Pemrograman">Bahasa Pemrograman</option>
          <option value="Ui/Ux">UI/UX</option>
          <option value="Umum">Lainnya</option>
       </select>
       <p>Harga <span>*</span></p>
       <input type="number" name="harga" maxlength="100" required placeholder="Rp..." class="box">
       <input type="submit" value="Tambah" name="submit" class="btn">

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
