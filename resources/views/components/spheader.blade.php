<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin ({{ $userName }})</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">

</head>

<body>
    {{-- <header class="header">

        <section class="flex">

            <a href="{{ url('/dashboardsp') }}" class="logo">Admin.</a>

            <form action="search_page.php" method="post" class="search-form">
                <input type="text" name="search" placeholder="search here..." required maxlength="100">
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

                <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
                    class="delete-btn">logout</a>

            </div>

        </section>

    </header> --}}

    <!-- header section ends -->

    <!-- side bar section starts  -->

    <div class="side-bar">

        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">

            <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
            <h3>{{ $userName }}</h3>
            <span>{{ $userProfesi }}</span>
            <a href="{{ url('profilesp') }}" class="btn">View Profile</a>

        </div>

        <nav class="navbar">
            <a href="{{ url('/dashboardsp') }}"><i class="fas fa-home"></i><span>Beranda</span></a>
            <a href="{{ route('tutor.index') }}"><i class="fa-solid fa-bars-staggered"></i><span>Tutor</span></a>
            <a href="{{ route('siswa.index') }}"><i class="fas fa-graduation-cap"></i><span>Siswa</span></a>
            <a href="{{ route('pages.datatransaksi') }}"><i class="fa-solid fa-circle-dollar-to-slot"></i><span>Transaksi</span></a>
            <a href="{{ route('logoutsp') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"><i class="fas fa-right-from-bracket"></i><span>Log out</span></a>

        </nav>

    </div>

    <!-- side bar section ends -->
    <main>
        @yield('main')
    </main>
    <script src="{{ asset('assets/js/admin_script.js') }}"></script>
</body>

</html>
