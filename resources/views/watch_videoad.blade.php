@extends('components.adminheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}


<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardad') }}" class="logo">Tutor</a>

        {{-- <form action="search_page.php" method="post" class="search-form">
            <input type="text" name="search" placeholder="search here..." required maxlength="100">
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
            <a href="{{ url('/profileadmin') }}" class="btn">view profile</a>

            <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">log out</a>

        </div>

    </section>

</header>



    <section class="view-content">

        @if($video)
            <div class="container">
                <video src="{{ asset('uploaded_files/' . $video->video) }}" class="video" poster="{{ asset('uploaded_files/' . $video->thumb) }}" controls autoplay></video>

                <h3 class="title">{{ $video->title }}</h3>
                <div class="date">
                    <p><i class="fas fa-calendar"></i><span>{{ $video->date }}</span></p>
                </div>
                {{-- @if($tutor)
                    <div class="tutor">
                        <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt="">
                        <div>
                            <h3>{{ $tutor->name }}</h3>
                            <span>{{ $tutor->profession }}</span>
                        </div>
                    </div>
                @endif --}}
                {{-- <form action="{{ route('like.video', ['videoId' => $video->id]) }}" method="post" class="flex">
                    @csrf
                    <input type="hidden" name="content_id" value="{{ $video->id }}">
                    <a href="playlist.php?get_id={{ $video->playlist_id }}" class="inline-btn">View Playlist</a>
                    @if($isLiked)
                        <button type="submit" name="like_content"><i class="fas fa-heart"></i><span>Liked</span></button>
                    @else
                        <button type="submit" name="like_content"><i class="far fa-heart"></i><span>Like</span></button>
                    @endif
                </form> --}}

                <div class="description"><p>{{ $video->description }}</p></div>
                <form action="{{ route('delete_video') }}" method="post">
                    <div class="flex-btn">
                        @csrf
                       <input type="hidden" name="video_id" value="{{ $video->id }}">
                       <a href="{{ route('update.content', ['videoId' => $video->id]) }}" class="option-btn">Ubah</a>
                       <input type="submit" value="Hapus" class="delete-btn" onclick="return confirm('Anda Yakin Ingin Menghapus Materi?');" name="delete_video">
                    </div>
                 </form>
            </div>
        @else
            <p class="empty">No videos added yet!</p>
        @endif

    </section>

    <section class="comments">

        {{-- <h1 class="heading">Add a Comment</h1>

        <form action="{{ route('video.storeComment', ['videoId' => $video->id]) }}" method="post" class="add-comment">
            @csrf
            <input type="hidden" name="content_id" value="{{ $video->id }}">
            <textarea name="comment_box" required placeholder="Write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" value="Add Comment" name="add_comment" class="inline-btn">
        </form> --}}

        <div class="show-comments">
            @if($comments->count() > 0)
            @foreach($comments as $comment)
               <div class="box" style="{{ $comment->tutor_id == $userId ? 'order:-1;' : '' }}">
                @php
                    $user = $users->where('id', $comment->user_id)->first();
                @endphp
                @if ($user)
                  <div class="user">
                    <img src="{{ asset('uploaded_files/' . $user->image) }}" alt="">
                    <div>
                        <h3>{{ $user->name }}</h3>
                        <span>{{ $comment->date }}</span>

                    </div>
                      {{-- <a href="{{ route('view.content', ['get_id' => $comment->content_id]) }}">View Content</a> --}}
                  </div>
                @endif
                  <p class="text">{{ $comment->comment }}</p>
                  <!-- Tampilkan nama pengguna -->
                  {{-- <p class="user-name">Commented by: {{ $comment->user_name }}</p> --}}
                  <form action="{{ route('delete.comment') }}" method="post">
                     @csrf
                     <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                     <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Delete this comment?');">Hapus Komentar</button>
                  </form>
               </div>
            @endforeach
         @else
            <p class="empty">Tidak ada komentar yang tersedia!</p>
         @endif
        </div>


    </section>

    {{-- <section class="edit-comment" id="edit-comment-section" style="display: none;">
        <h1 class="heading">Edit Comment</h1>
        <form action="{{ route('video.updateComment', ['videoId' => $video->id, 'commentId' => $comment->id]) }}" method="post" id="edit-comment-form">
            @csrf
            <input type="hidden" name="update_id" value="{{ $comment->id }}">
            <textarea name="update_box" class="box" maxlength="1000" required placeholder="Please enter your comment" cols="30" rows="10">{{ $comment->comment }}</textarea>
            <div class="flex">
                <a href="#" id="cancel-edit-btn" class="inline-option-btn">Cancel Edit</a>
                <input type="submit" value="Update Now" name="update_now" class="inline-btn">
            </div>
        </form>
    </section> --}}

@endsection
