@extends('components.spheader')
@section('main')
<link rel="stylesheet" href="assets/css/admin_style.css">

<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardsp') }}" class="logo">Admin</a>

        {{-- <form action="{{ route('detailsiswa.carisiswadalam') }}" method="post" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="Cari Siswa..." required maxlength="100">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form> --}}

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
            <a href="{{ url('/profilesp') }}" class="btn">view profile</a>

            <a href="{{ route('logoutsp') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">log out</a>

        </div>

    </section>

</header>

<section class="tutor-profile" style="min-height: calc(100vh - 19rem);">

    <h1 class="heading">Detail Profil</h1>

    @if (session('success'))
    <div class="modal-box" id="success-message">
        <i class="fa-solid fa-check-to-slot"></i>
        <h2>Success</h2>
        <h3>{{ session('success') }}</h3>
        <div class="but">
            <button class="tutupbut" onclick="closeModalAndClearSession()">OK</button>
        </div>
    </div>
    @elseif (session('error'))
        <div id="error-message" class="popup-message">{{ session('error') }}</div>
    @endif

    <div class="details">

       <div class="tutor">
        <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
        <h3>{{ $userName }}</h3>
        <span>{{ $userProfesi }}</span>
        <a href="{{ route('tutors.editsp', $tutorsId) }}" class="inline-btn">update profile</a>
       </div>

       <div class="flex">
        <div class="box">
           <span>{{ $totalTutors }}</span>
           <p>Total Tutor</p>
           <a href="{{ route('tutor.index') }}" class="btn">view Tutor</a>
        </div>
        <div class="box">
           <span>{{ $totalUsers }}</span>
           <p>Total Siswa</p>
           <a href="{{ route('siswa.index') }}" class="btn">view Siswa</a>
        </div>
        <div class="box">
           <span></span>
           <p>Total Pendapatan</p>
           <a href="" class="btn">view Transaksi</a>
        </div>
        {{-- <div class="box">
           <span></span>
           <p>total comments</p>
           <a href="" class="btn">view comments</a>
        </div> --}}
     </div>

    </div>

 </section>
@endsection
