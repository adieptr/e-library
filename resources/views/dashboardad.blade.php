@extends('components.adminheader')
@section('main')
    <header class="header">

        <section class="flex">

            <a href="{{ url('/dashboardad') }}" class="logo">Tutor</a>

            <form action="{{ route('pages.carisiswaad') }}" method="post" class="search-form">
                @csrf
                <input type="text" name="keyword" placeholder="Cari Siswa..." required maxlength="100">
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
                <a href="{{ url('/profileadmin') }}" class="btn">View Profile</a>

                <a href="{{ route('logoutad') }}" onclick="return confirm('Anda Yakin Ingin Lo gout?');"
                class="delete-btn">Log out</a>

            </div>

        </section>

    </header>


    <section class="dashboard">



        <div class="content">

            <main>
                {{-- <div class="header">
                    <div class="left">
                        <h1>Dashboard</h1>
                    </div>
                </div> --}}

                <!-- Insights -->
                <ul class="insights">
                    <a href="{{ route('coursesad.index') }}">
                        <li>
                            <i class='bx bx-book-open'></i>
                            <span class="info">
                                <h3>
                                    {{ $totalPlaylists }}
                                </h3>
                                <p>Total Kursus</p>
                            </span>
                        </li>
                    </a>

                    <a href="{{ route('contentad.index') }}">
                        <li><i class='bx bx-copy-alt'></i>
                            <span class="info">
                                <h3>
                                    {{ $totalContents }}
                                </h3>
                                <p>Total Materi</p>
                            </span>
                        </li>
                    </a>

                    <a href="{{ route('commentsad') }}">
                        <li><i class='bx bx-comment-detail'></i>
                            <span class="info">
                                <h3>
                                    {{ $totalComments }}
                                </h3>
                                <p>Total Komentar</p>
                            </span>
                        </li>
                    </a>

                    <a href="">
                        <li><i class='bx bx-user'></i>
                            <span class="info">
                                <h3>
                                    {{ $totalUsers }}
                                </h3>
                                <p>Total Siswa</p>
                            </span>
                        </li>
                    </a>
                </ul>
                <!-- End of Insights -->

                <div class="bottom-data">
                    <div class="orders">
                        <div class="header2">
                            <i class='bx bx-receipt'></i>
                            <h3>Data Siswa</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Email</th>
                                    <th>Kursus</th>
                                    {{-- <th>Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dtlsiswa as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('uploaded_files/' . $item->user->image) }}" alt="">
                                            <p style="font-size: 20px">{{ $item->user->name }}</p>
                                        </td>
                                        <td>
                                            <p style="font-size: 20px">{{ $item->user->email }}</p>
                                        </td>
                                        <td style="font-size: 20px">
                                            @if (isset($item->playlist) && isset($item->playlist->title))
                                                {{ $item->playlist->title }}
                                            @else
                                                Nama Kursus Tidak Tersedia
                                            @endif
                                        </td>
                                        {{-- <td><span class="status completed">Selesai</span></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </main>

        </div>




    </section>
@endsection
