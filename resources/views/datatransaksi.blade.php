@extends('components.spheader')
@section('main')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <header class="header">

        <section class="flex">

            <a href="{{ url('/dashboardsp') }}" class="logo">Admin</a>

            <form action="{{ route('caritransaksi') }}" method="get" class="search-form">
                <input type="text" name="search" placeholder="Cari Transaksi..." required maxlength="100" value="{{ request('search') }}">
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
                    class="delete-btn">log out</a>

            </div>

        </section>

    </header>


    <section class="dashboard">






        <div class="content">

            <main>


                <div class="bottom-data">
                    <div class="orders">
                        <div class="header2">
                            <i class='bx bx-receipt'></i>
                            <h3>Data Keuangan</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Kursus</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Bukti Pembayaran</th>
                                    {{-- <th>Status</th> --}}
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('uploaded_files/' . $transaction->user->image) }}"
                                                alt="">
                                            <p style="font-size: 15px">{{ $transaction->user->name }}</p>
                                        </td>
                                        <td style="font-size: 15px">
                                            @if ($transaction->playlist)
                                                {{ $transaction->playlist->title }}
                                            @else
                                                Nama Kursus Tidak Tersedia
                                            @endif
                                        </td>
                                        <td style="font-size: 15px">
                                            @if ($transaction->playlist)
                                                Rp  {{ number_format($transaction->playlist->harga, 0, ',', '.') }}
                                            @else
                                                Nama Kursus Tidak Tersedia
                                            @endif
                                        </td>
                                        <td style="font-size: 15px">
                                            @if($transaction->status == 'pending')
                                                Belum lunas
                                            @elseif($transaction->status == 'ongoing')
                                                Lunas
                                             @elseif($transaction->status == 'selesai')
                                                Kursus Selesai
                                            @else
                                                {{ $transaction->status }}
                                            @endif
                                        </td>

                                        <td style="font-size: 15px">
                                            @if ($transaction->tanggal)
                                                {{ $transaction->tanggal }}
                                            @else
                                                Bukti Pembayaran Tidak Tersedia
                                            @endif
                                        </td>
                                        <td style="font-size: 15px; text-align: center;">
                                            @if ($transaction->bukti_pembayaran)
                                                <img src="{{ asset('uploaded_files/' . $transaction->bukti_pembayaran) }}"
                                                    alt="Bukti Pembayaran" style="border-radius: 0; ">
                                            @else
                                                Bukti Pembayaran Tidak Tersedia
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="aksi">
                                                <a href="{{ route('transaksi.tampiluptra', $transaction->id_transaksi) }}"
                                                    class="tomedit">Edit</a>
                                                {{-- <a href="#" class="tomhapus">Hapus</a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="pagination">
                        {{ $transactions->links() }}
                        <div class="custom-pagination">
                            @if ($transactions->previousPageUrl())
                                <a href="{{ $transactions->previousPageUrl() }}" class="btn btn-prev">Previous</a>
                            @endif
                            @if ($transactions->nextPageUrl())
                                <a href="{{ $transactions->nextPageUrl() }}" class="btn btn-next">Next</a>
                            @endif
                        </div>
                    </div> --}}

                </div>

            </main>

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
                liTag +=
                    `<li class="newbtn prev" onclick="changePage(${page - 1})"><span><i class="fas fa-angle-left"></i> Prev</span></li>`;
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
                liTag +=
                    `<li class="newbtn next" onclick="changePage(${page + 1})"><span>Next <i class="fas fa-angle-right"></i></span></li>`;
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
