@extends('components.adminheader')
@section('main')
<link rel="stylesheet" href="assets/css/admin_style.css">
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


<section class="tutor-profile" style="min-height: calc(100vh - 19rem);">


    <h1 class="heading">profile details</h1>

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


    @if (session('sucesup'))
    <div class="modal-up" id="success-message">
        <i class="fa-solid fa-thumbs-up"></i>
        <h2>Success</h2>
        <h3>{{ session('sucesup') }}</h3>
        <div class="butup">
            <button class="tutupbutup" onclick="closeModalAndClearSession()">OK</button>
        </div>
    </div>
    @elseif (session('errorup'))
        <div id="error-message" class="popup-message">{{ session('error') }}</div>
    @endif

    <div class="details">

       <div class="tutor">
        <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
        <h3>{{ $userName }}</h3>
        <span>{{ $userProfesi }}</span>
        <a href="{{ route('tutors.edit', $tutorsId) }}" class="inline-btn">update profile</a>
       </div>

       <div class="flex">
        <div class="box">
           <span>{{ $totalPlaylists }}</span>
           <p>Total Materi</p>
           <a href="{{ route('coursesad.index') }}" class="btn">view Materi</a>
        </div>
        <div class="box">
           <span>{{ $totalContents }}</span>
           <p>Total Contents</p>
           <a href="{{ route('contentad.index') }}" class="btn">view contents</a>
        </div>
        <div class="box">
           <span>{{ $totalUsers }}</span>
           <p>Total Siswa</p>
           <a href="{{ url('/dashboardad') }}" class="btn">view dashboard</a>
        </div>
        <div class="box">
           <span> {{ $totalComments }}</span>
           <p>Total Comments</p>
           <a href="{{ route('commentsad') }}" class="btn">view comments</a>
        </div>
     </div>

    </div>

 </section>
@endsection
