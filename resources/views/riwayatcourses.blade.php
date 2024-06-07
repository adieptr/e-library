@extends('components.userheader')
@section('main')

<section class="courses">

    <h1 class="heading">Riwayat Kursus</h1>

    <div class="box-container">

        @forelse ($playlists as $playlist)
        <div class="box">
            <div class="tutor">
                <img src="uploaded_files/{{ $playlist->tutor->image }}" alt="">
                <div>
                    <h3>{{ $playlist->tutor->name }}</h3>
                    <span>{{ $playlist->date }}</span>
                </div>
            </div>
            <img src="uploaded_files/{{ $playlist->thumb }}" class="thumb" alt="">
            <h3 class="title">{{ $playlist->title }}</h3>
            <a href="{{ route('playlist.showPlaylist', ['id' => $playlist->id]) }}" class="inline-btn">Lihat Kursus</a>
        </div>
        @empty
        <p class="empty">Belum ada kursus yang diselesaikan!</p>
        @endforelse

    </div>

</section>

@endsection
