<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/dash.css">
    <title>Codinggo</title>
</head>

<body>

    <div class="container">

        <aside class="left-section">
            <div class="logo">
                <button class="menu-btn" id="menu-close">
                    <i class='bx bx-log-out-circle'></i>
                </button>
                <img src="assets/images/demo/start-hub-2/logo/sidelogo.png">
                <a href="{{ url('/dashboarduser') }}">Codinggo</a>
            </div>

            <div class="sidebar">
                <div class="item" id="active">
                    <i class='bx bx-home-alt-2'></i>
                    <a href="#">Dashboard</a>
                </div>
                <div class="item">
                    <i class='bx bx-grid-alt'></i>
                    <a href="#">Kursus</a>
                </div>
                <div class="item">
                    <i class='bx bx-cart'></i>
                    <a href="#">Keranjang</a>
                </div>
                <div class="item">
                    <i class='bx bx-task'></i>
                    <a href="#">Tugas</a>
                </div>
                <div class="item">
                    <i class='bx bx-cog'></i>
                    <a href="#">Pengaturan</a>
                </div>
                <div class="item">
                    <i class='bx bx-log-out'></i>
                    <form action="/logout" method="POST" id="logout-form">
                        @csrf
                        <a href="#" class="logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
                        </a>
                    </form>
                </div>
            </div>

            <div class="pic">
                <img src="assets/images/demo/start-hub-2/logo/logo_biru.png">
            </div>

            <div class="upgrade">
                {{-- <h5>Upgrade Your Plan</h5>
                <div class="link">
                    <a href="#">Go to <b>PRO</b></a>
                    <i class='bx bxs-chevron-right'></i>
                </div> --}}
            </div>

        </aside>

        <main>
            @yield('main')
        </main>

        <aside class="right-section">
            @yield('right')
        </aside>

    </div>

    <script src="assets/js/dash.js"></script>
</body>

</html>
