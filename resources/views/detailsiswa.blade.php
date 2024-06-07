@extends('components.spheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}

<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardsp') }}" class="logo">Admin.</a>

        <form action="{{ route('detailsiswa.carisiswadalam') }}" method="post" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="Cari Siswa..." required maxlength="100">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form>

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
            class="delete-btn">logout</a>

        </div>

    </section>

</header>

<section class="playlist-details">

    <h1 class="heading">Detail Tutor</h1>

    <div class="row">

       @if($tutor)
          <div class="thumb">
             {{-- @if($videos)
             <span>{{ $videos->count() }} Sesi</span>
             @endif --}}
             <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt="">
          </div>


       <div class="col">
        {{-- @if($tutor)
        <div class="tutor">
            <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt="">
            <div>
                <h3>{{ $tutor->name }}</h3>
                <span>{{ $tutor->profession }}</span>
            </div>
        </div>
        @else --}}
        {{-- <div class="tutor">
            <img src="path_to_default_image/default.jpg" alt="">
            <div>
                <h3>Tutor Not Found</h3>
                <span>N/A</span>
            </div>
        </div> --}}
        {{-- @endif --}}
          <div class="details">
             <h3 class="title">{{ $tutor->name }}</h3>
             <div class="description">{{ $tutor->profession }}</div>
             <div class="date"><i class="fa-solid fa-at"></i><span>{{ $tutor->email }}</span></div>

             {{-- <form action="{{ route('delete_playlist') }}" method="post" class="flex-btn">
                @csrf
                <input type="hidden" name="playlist_id" value="{{ $playlist->id }}">
                <a href="{{ route('update_playlist_view', ['get_id' => $playlist->id]) }}" class="option-btn">update playlist<a>
                <input type="submit" value="delete playlist" class="delete-btn" onclick="return confirm('delete this playlist?');" name="delete">
             </form> --}}
          </div>
       </div>

       @else
       <p class="empty">This playlist was not found!</p>
       @endif

    </div>
</section>

 <!-- playlist section ends -->

 <!-- videos container section starts  -->

 <section class="contents">

    <h1 class="heading">Siswa Yang Diampu</h1>

            <div class="box-container">
                @if($videos->isNotEmpty())
                    @foreach($videos as $video)
                    <div class="box">
                        <div class="flex">
                           {{-- <div><i class="fas fa-dot-circle" style="{{ $video->status == 'active' ? 'color:limegreen' : 'color:red' }}"></i><span style="{{ $video->status == 'active' ? 'color:limegreen' : 'color:red' }}">{{ $video->status }}</span></div>
                           <div><i class="fas fa-calendar"></i><span>{{ $video->date }}</span></div> --}}
                        </div>
                        <img src="../uploaded_files/{{ $video->image }}" class="thumb" alt="">
                        <h3 class="title">{{ $video->name }}</h3>
                        <h3 class="title">{{ $video->email }}</h3>
                        {{-- <form action="{{ route('delete_video') }}" method="post" class="flex-btn">
                           @csrf
                           <input type="hidden" name="video_id" value="{{ $video->id }}">
                           <a href="{{ route('update.content', ['videoId' => $video->id]) }}" class="option-btn">Update</a>

                           <button type="submit" class="delete-btn" onclick="return confirm('Delete this video?');">Delete</button>
                        </form> --}}
                        {{-- <a href="{{ route('watchad.video', ['id' => $video->id]) }}" class="btn">View content</a> --}}
                     </div>
                    @endforeach
                @else
                    <p class="empty">No videos added yet!</p>
                @endif
            </div>

 </section>

 <!-- videos container section ends -->

@endsection
