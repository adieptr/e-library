@extends('components.spheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}


{{-- <header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardad') }}" class="logo">Tutor.</a>



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

</header> --}}




<section class="playlist-form">
    <h1 class="heading">Update Transaksi</h1>

    <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="post" enctype="multipart/form-data">
        @csrf <!-- Tambahkan CSRF token untuk keamanan form -->
        @method('PUT')

        <!-- Input tersembunyi untuk menyimpan ID playlist -->
        <input type="hidden" name="get_id" value="{{ $transaksi->id_transaksi }}">

        <p>-- Status Pembayaran --<span>*</span></p>
        <select name="status" class="box" required>
            {{-- <option value="{{ $dtlsiswa->status }}" selected>{{ $dtlsiswa->status }}</option>
            <option value="pending">Tidak disetujui</option>
            <option value="ongoing">Disetujui</option> --}}
            <option value="ongoing" {{$dtlsiswa->status == "ongoing" ? 'selected' : ''}}>Lunas</option>
            <option value="pending" {{$dtlsiswa->status == "pending" ? 'selected' : ''}}>Belum Lunas</option>
        </select>

        <p>Nama Siswa<span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Enter playlist title" value="{{ $siswa->name }}" class="box" disabled>

        <p>Nama Kurus<span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Enter playlist title" value="{{ $course->title }}" class="box" disabled>

        <p>Bukti Pembayaran<span>*</span></p>
        <div class="thumb" style="height: 62rem;">
            <img src="{{ asset('uploaded_files/' . $transaksi->bukti_pembayaran) }}" alt="Playlist Thumbnail">
        </div>

        <p>Harga<span>*</span></p>
        <input type="text" name="harga" maxlength="100" required placeholder="Masukkan Harga" value="{{ $course->harga }}" class="box" disabled>

        <input type="submit" value="Update Transaksi" name="submit" class="btn">
    </form>
</section>

@endsection
