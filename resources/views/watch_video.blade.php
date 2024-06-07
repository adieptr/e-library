@extends('components.userheader')
@section('main')
    <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
    <script src="{{ asset('assets/js/user_script.js') }}"></script>





    {{-- <script>
        // Script to toggle visibility of edit comment section
        document.addEventListener("DOMContentLoaded", function() {
            const editCommentSection = document.querySelector('.edit-comment');
            const cancelEditBtn = document.querySelector('.cancel-edit');

            cancelEditBtn.addEventListener('click', function() {
                editCommentSection.style.display = 'none';
            });
        });
    </script> --}}


    <section class="watch-video">

        @if($video)
            <div class="video-details">
                <video src="{{ asset('uploaded_files/' . $video->video) }}" class="video" poster="{{ asset('uploaded_files/' . $video->thumb) }}" controls autoplay></video>

                <h3 class="title">{{ $video->title }}</h3>
                <div class="info">
                    <p><i class="fas fa-calendar"></i><span>{{ $video->date }}</span></p>
                </div>
                @if($tutor)
                    <div class="tutor">
                        <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt="">
                        <div>
                            <h3>{{ $tutor->name }}</h3>
                            <span>{{ $tutor->profession }}</span>
                        </div>
                    </div>
                @endif
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
            </div>
        @else
            <p class="empty">Tidak ada video yang ditambahkan!</p>
        @endif

    </section>

    <section class="comments">

        <h1 class="heading">Tambah Komentar</h1>

        <form action="{{ route('video.storeComment', ['videoId' => $video->id]) }}" method="post" class="add-comment">
            @csrf
            <input type="hidden" name="content_id" value="{{ $video->id }}">
            <textarea name="comment_box" required placeholder="Write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" value="Add Comment" name="add_comment" class="inline-btn">
        </form>

        <div class="show-comments">
            @if($comments->count() > 0)
                @foreach($comments as $comment)
                    <div class="box" style="{{ $comment->user_id == $userId ? 'order:-1;' : '' }}">
                        <div class="user">
                            @php
                                $user = $users->where('id', $comment->user_id)->first();
                            @endphp
                            @if ($user)
                                <img src="{{ asset('uploaded_files/' . $user->image) }}" alt="">
                                <div>
                                    <h3>{{ $user->name }}</h3>
                                    <span>{{ $comment->date }}</span>
                                </div>
                            @endif
                        </div>
                        <p class="text">{{ $comment->comment }}</p>
                        @if($comment->user_id == $userId)
                            <form action="{{ route('video.editComment', ['videoId' => $video->id, 'commentId' => $comment->id]) }}" method="post" class="flex-btn">
                                @csrf
                                {{-- <button type="submit" name="edit_comment" class="inline-option-btn">Edit Comment</button> --}}
                            </form>
                            <form action="{{ route('video.deleteComment', ['videoId' => $video->id, 'commentId' => $comment->id]) }}" method="post" class="flex-btn">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Hapus komentar ini?');">Hapus Komentar</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="empty">Tidak ada komentar!</p>
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
