@extends('sidebarad')
@section('main')
    <div class="header">
        <div class="left">
            <h1>Data User</h1>
            {{-- <ul class="breadcrumb">
            <li><a href="#">
                    Analytics
                </a></li>
            /
            <li><a href="#" class="active">Shop</a></li>
        </ul> --}}
        </div>
        <a href="#" class="report">
            <i class='bx bx-cloud-download'></i>
            <span>Download PDF</span>
        </a>
    </div>
    <main class="table" id="customers_table">
        <section class="table__header">
            {{-- <h1>Data Siswa</h1> --}}
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="assets/imgs/search.png" alt="">
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> No </th>
                        <th> Nama Lengkap </th>
                        <th> NIK </th>
                        <th> Tempat Tgl Lahir </th>
                        <th> Jenis Kelamin </th>
                        <th> Agama </th>
                        <th> Alamat </th>
                        <th> No.HP </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 1 </td>
                        <td> hendra springbed </td>
                        <td> 000000000 </td>
                        <td> 17 Dec 2022 </td>
                        <td> lanang </td>
                        <td> random </td>
                        <td> ngawi </td>
                        <td> 888888888 </td>
                    </tr>
                    <tr>
                        <td> 2 </td>
                        <td> hendra springbed </td>
                        <td> 000000000 </td>
                        <td> 17 Dec 2022 </td>
                        <td> lanang </td>
                        <td> random </td>
                        <td> ngawi </td>
                        <td> 888888888 </td>
                    </tr>
                    <tr>
                        <td> 3 </td>
                        <td> hendra springbed </td>
                        <td> 000000000 </td>
                        <td> 17 Dec 2022 </td>
                        <td> lanang </td>
                        <td> random </td>
                        <td> ngawi </td>
                        <td> 888888888 </td>
                    </tr>

                </tbody>
            </table>
        </section>
    </main>
@endsection
