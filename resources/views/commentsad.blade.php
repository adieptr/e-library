@extends('components.adminheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}


<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardad') }}" class="logo">Tutor</a>

        <form action="{{ route('caricommentsad') }}" method="post" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="Cari komentar..." required maxlength="100">
            <button type="submit"><i class="fas fa-search"></i></button>
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
            <a href="{{ url('/profileadmin') }}" class="btn">View Profile</a>

            <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">Log out</a>

        </div>

    </section>

</header>


<section class="comments">
    <h1 class="heading">Komentar Siswa</h1>

    <div class="show-comments">
       @if($comments->count() > 0)
          @foreach($comments as $comment)
             <div class="box" style="{{ $comment->tutor_id == $tutor_id ? 'order:-1;' : '' }}">
                <div class="content"><span>{{ $comment->date }}</span><p> - {{ $comment->user_name }} -> </p><a style="padding-left: 0px" href="{{ route('watchad.content', ['id' => $comment->id]) }}">Materi : {{ $comment->materi_name }} </a>
                    {{-- <a href="{{ route('view.content', ['get_id' => $comment->content_id]) }}">View Content</a> --}}
                </div>
                <p class="text">{{ $comment->comment }}</p>
                <!-- Tampilkan nama pengguna -->
                {{-- <p class="user-name">Commented by: {{ $comment->user_name }}</p> --}}
                <form action="{{ route('delete.comment') }}" method="post">
                   @csrf
                   <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                   <a href="{{ route('watchad.content', ['id' => $comment->id]) }}" class="inline-delete-btn" style="width: 195px; background-color: #0391c5;">Lihat Materi</a>
                   <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Anda Yakin Ingin Menghapus Komentar?');">Hapus Komentar</button>

                </form>

             </div>
          @endforeach
       @else
          <p class="empty">Tidak ada komen yang tersedia!</p>
       @endif
    </div>
    <div class="page">
        <div class="pagination">
            <ul> <!-- pages or li are comes from javascript --> </ul>
        </div>
 </section>

 <script>
    function closeModalAndClearSession() {
        document.getElementById('success-message').style.display = 'none';
        // Tambahkan kode untuk menghapus sesi jika diperlukan
    }

    const element = document.querySelector(".pagination ul");
    const totalPages = {{ $totalPages }};
    const currentPage = {{ $currentPage }};

    element.innerHTML = createPagination(totalPages, currentPage);

    function createPagination(totalPages, page) {
        let liTag = '';
        let active;
        let beforePage = page - 1;
        let afterPage = page + 1;
        if (page > 1) {
            liTag += `<li class="newbtn prev" onclick="changePage(${page - 1})"><span><i class="fas fa-angle-left"></i> Prev</span></li>`;
        }

        if (page > 2) {
            liTag += `<li class="first numb" onclick="changePage(1)"><span>1</span></li>`;
            if (page > 3) {
                liTag += `<li class="dots"><span>...</span></li>`;
            }
        }

        // if (page == totalPages) {
        //     beforePage = beforePage - 2;
        // } else if (page == totalPages - 1) {
        //     beforePage = beforePage - 1;
        // }
        if (page == 1) {
            afterPage = afterPage + 2;
        } else if (page == 2) {
            afterPage = afterPage + 1;
        }

        for (var plength = beforePage; plength <= afterPage; plength++) {
            if (plength > totalPages) {
                continue;
            }
            if (plength == 0) {
                plength = plength + 1;
            }
            if (page == plength) {
                active = "active";
            } else {
                active = "";
            }
            liTag += `<li class="numb ${active}" onclick="changePage(${plength})"><span>${plength}</span></li>`;
        }

        if (page < totalPages - 1) {
            if (page < totalPages - 2) {
                liTag += `<li class="dots"><span>...</span></li>`;
            }
            liTag += `<li class="last numb" onclick="changePage(${totalPages})"><span>${totalPages}</span></li>`;
        }

        if (page < totalPages) {
            liTag += `<li class="newbtn next" onclick="changePage(${page + 1})"><span>Next <i class="fas fa-angle-right"></i></span></li>`;
        }
        element.innerHTML = liTag;
        return liTag;
    }

    function changePage(page) {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
    }
</script>
@endsection
