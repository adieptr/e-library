<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/dashad.css">
    <title>Codinggo Admin</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ url('/dashboardad') }}" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Coding</span>go</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="{{ url('/dashboardad') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#"><i class='bx bx-store-alt'></i>Transaksi</a></li>
            <li><a href="#"><i class='bx bx-analyse'></i>Analisis</a></li>
            <li><a href="{{ url('/kursus') }}"><i class='bx bx-message-square-dots'></i>Kursus</a></li>
            <li><a href="{{ url('/datauser') }}"><i class='bx bx-group'></i>Siswa</a></li>
            <li><a href="#"><i class='bx bx-cog'></i>Pengaturan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <form action="/logout" method="POST" id="logout-form">
                    @csrf
                    <a href="#" class="logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out-circle'></i>
                        Log out
                    </a>
                </form>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            {{-- <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label> --}}
            {{-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a> --}}
            <a href="#" class="profile">
                <img src="assets/images/demo/start-hub-2/img/profile.jpg">
            </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            @yield('main')
        </main>

    </div>

    <script src="assets/js/dashad.js"></script>
</body>

</html>
