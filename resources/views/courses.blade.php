@extends('components.userheader')
@section('main')

<section class="courses">

    <h1 class="heading">Daftar Kursus</h1>

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
            <a href="{{ route('playlist.showPlaylist', ['id' => $playlist->id]) }}"><img src="uploaded_files/{{ $playlist->thumb }}" class="thumb" alt=""></a>
            <h3 class="title">{{ $playlist->title }}</h3>
            <a href="{{ route('playlist.showPlaylist', ['id' => $playlist->id]) }}" class="inline-btn-btn">Lihat Kursus</a>
            <form action="{{ route('complete.course', ['playlist_id' => $playlist->id]) }}" method="POST" style="display: inline;" onsubmit="return confirmCompletion()">
                @csrf
                <button type="submit" class="inline-btn">Akhiri Kursus</button>
            </form>
        </div>
        @empty
        <p class="empty">Tidak ada kursus yang sedang berlangsung!</p>
        @endforelse

    </div>

</section>

<script>
function confirmCompletion() {
    return confirm('Apakah Anda Yakin Ingin Mengakhiri Kursus?');
}
</script>

@endsection
