@extends('components.userheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
<script src="{{ asset('assets/js/user_script.js') }}"></script>
<section class="playlist">

    <h1 class="heading">Detail Kursus</h1>

    <div class="row">

       @if($playlist)
       <div class="col">
          {{-- <form action="" method="post" class="save-list">
             <input type="hidden" name="list_id" value="{{ $playlist->	tutor_id }}">
             @if($isSaved)
             <button type="submit" name="save_list"><i class="fas fa-bookmark"></i><span>Saved</span></button>
             @else
             <button type="submit" name="save_list"><i class="far fa-bookmark"></i><span>Save Playlist</span></button>
             @endif
          </form> --}}
          <div class="thumb">
             @if($videos)
             <span>{{ $videos->count() }} Sesi</span>
             @endif
             <img src="{{ asset('uploaded_files/' . $playlist->thumb) }}" alt="">
          </div>
       </div>

       <div class="col">
        @if($tutor)
        <div class="tutor">
            <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt="">
            <div>
                <h3>{{ $tutor->name }}</h3>
                <span>{{ $tutor->profession }}</span>
            </div>
        </div>
        @else
        <div class="tutor">
            <img src="path_to_default_image/default.jpg" alt="">
            <div>
                <h3>Tutor tidak ditemukan</h3>
                <span>N/A</span>
            </div>
        </div>
        @endif
          <div class="details">
             <h3>{{ $playlist->title }}</h3>
             <p>{{ $playlist->description }}</p>
             <div class="date"><i class="fas fa-calendar"></i><span>{{ $playlist->date }}</span></div>
          </div>
       </div>

       @else
       <p class="empty">Kursus tidak ditemukan!</p>
       @endif

    </div>

 </section>

 <!-- playlist section ends -->

 <!-- videos container section starts  -->

 <section class="videos-container">

    <h1 class="heading">Materi Belajar</h1>

            <div class="box-container">
                @if($videos->isNotEmpty())
                    @foreach($videos as $video)
                    <a href="{{ route('watch.video', ['id' => $video->id]) }}" class="box">

                            <i class="fas fa-play"></i>
                            <img src="{{ asset('uploaded_files/' . $video->thumb) }}" alt="">
                            <h3>{{ $video->title }}</h3>
                        </a>
                    @endforeach
                @else
                    <p class="empty">Tidak ada materi yang ditambahkan!</p>
                @endif
            </div>

 </section>

 <!-- videos container section ends -->

@endsection
