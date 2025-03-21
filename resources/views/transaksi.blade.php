<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Codinggo" name="keywords">
    <meta content="LiquidThemes" name="author">
    <meta content="Codinggo" name="description">
    <meta content="Codinggo" property="og:title">
    <meta content="Codinggo" property="og:description">
    <meta content="website" property="og:type">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="{{ asset('./assets/images/common/og-image.jpg') }}" property="og:image">
    <link href="{{ asset('assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/utility.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/demo/start-hub-2.css') }}" rel="stylesheet">
    <title>Detail Pembelian</title>
    <!-- Linking CSS File -->

    <!-- Fontawesome link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <!-- Bootstrap link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tran.css') }}" />
</head>

<body>

    @if (session('success'))
        <!-- Success message handling -->
    @elseif (session('error'))
        <div class="modal-sal" id="gagal-message">
            <i class="fa-solid fa-circle-exclamation"></i>
            <h2>Gagal</h2>
            <h3>{{ session('error') }}</h3>
            <div class="butsal">
                <button class="tutupsal" onclick="closeModalAndClearSession()">OK</button>
            </div>
        </div>
    @endif


    <header class="main-header main-header-overlay" data-sticky-header="true" data-sticky-values-measured="false"
        id="site-header">
        <div class=" text-white-10 pl-30 pr-10 module-header"
            style="border-bottom: 2px solid rgb(92, 139, 226); box-shadow: 1px 1px 30px rgba(0, 0, 0, 0.2);">
            <div class="container-fluiud flex items-center justify-between">
                <div class="w-25percent flex items-center justify-start xl:w-15percent lg:w-40percent">
                    <div class="flex navbar-brand-plain py-20 sm:hidden"><a class="navbar-brand flex p-0 relative"
                            href="/dashboarduser" rel="home"><span class="navbar-brand-inner post-rel"><img
                                    alt="StartInaama" class="logo-sticky"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo-d-1.svg') }}"> <img
                                    alt="StartInaama" class="logo-default"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo.png') }}"></span></a>
                    </div>
                    <div class="navbar-brand-plain py-20 xxl:hidden xl:hidden sm:flex"><a
                            class="navbar-brand flex p-0 relative" href="/dashboarduser" rel="home"><span
                                class="navbar-brand-inner post-rel"><img alt="StartInaama" class="logo-sticky"
                                    src="assets/images/demo/start-hub-2/logo/logo-mob-d.svg">
                                <img alt="StartInaama" class="logo-default"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo.png') }}"></span></a>
                    </div>
                </div>
                <div class="w-50percent flex items-center justify-center header-desktop xl:w-55percent lg:hidden">
                    <div class="module-primary-nav flex link-14">
                        <div aria-expanded="false"
                            class="link-font-medium navbar-collapse inline-flex p-0 lqd-submenu-default-style"
                            role="navigation">

                        </div>
                    </div>
                </div>
                <div class="w-25percent flex items-center justify-end mr-20 lg:w-60percent lg:mr-0">
                    <div class="flex items-center justify-end">
                        <div class="module-social lg:hidden">

                        </div>
                        <a class="btn-hover" href="/courses"
                            style="display: inline-block; padding: 0.375em 0.75em; border: none; cursor: pointer; text-align: center; text-decoration: none; transition: all 0.3s ease; background-color: #FF7F3F; color: white; border-radius: 100px; margin-left: 10px; font-size: 15px; font-weight: 500; width: 200px;">
                            <span class="btn-txt" data-text="Login">Dashboard</span>
                        </a>


                        <div class="ml-15 ld-module-sd ld-module-sd-hover ld-module-sd-right xxl:hidden lg:block">
                            <button aria-expanded="false"
                                class="bg-transparent border-none nav-trigger flex relative items-center justify-center style-6 collapsed"
                                data-bs-target="#lqd-drawer-mobile" data-bs-toggle="collapse" data-ld-toggle="true"
                                data-toggle-options="{&quot;cloneTriggerInTarget&quot;: false, &quot;type&quot;: &quot;click&quot;}"
                                role="button" type="button">
                            </button>

                            <div class="lqd-module-backdrop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>



    <!-- Portfolio Section -->
    <p class="jud"> <a href="/dashboarduser">Home</a> > <span onclick="history.back()">Deskripsi</span> >
        <span>Beli</span>
    </p>
    <section class="container py-5 mt-100" id="portfolio">
        <article>
            <h1>Detail Peminjaman</h1>
        </article>
        <article>
            <h1>{{ $course->title }}</h1>
            <p>{{ $course->description }}</p>
            <h4 style="font-weight: bold">Harga</h4>
            {{-- <p style="text-decoration:line-through; color: rgb(110, 0, 0);">Rp.120,000</p> --}}
            <p style="font-weight: bold;">Rp. {{ number_format($course->harga, 0, ',', '.') }}</p>
        </article>

        <article>
            <h1>Materi kursus</h1>
            <ul style="list-style-type: none;">
                @foreach ($contents as $content)
                    <li>{{ $content->title }}</li>
                @endforeach
            </ul>
        </article>

        <article class="metod">
            <h1>Metode Pembayaran</h1>
            <ul>
                <li><span class="bx--wallet"></span> Dana : 085707038940</li>
                <li><span class="bx--credit-card"></span> No.Rek : 1234567891234</li>
            </ul>
        </article>

        <article class="form2">
            <h1>Upload Bukti Pembayaran</h1>
            <form action="{{ route('create.transaction') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="bukti_pembayaran" required>
                <input type="hidden" name="playlist_id" value="{{ $course->id }}">
                <button type="submit">Check out</button>
            </form>
        </article>

        <article class="batal">
            <h1>Pembatalan Pembayaran</h1>
            <p>Jika anda ingin membatalkan pembayaran tekan tombol Hubungi di bawah ini untuk menghubungi admin kami</p>
            <div class="tomhub">
                <a href="#" class="hub">Hubungi</a>
            </div>

        </article>
    </section>



    <footer class="main-footer" id="site-footer">
        <section class="lqd-section footer-content pt-270 pb-100 relative bg-transparent transition-all"
            style="background-image: linear-gradient(180deg, #E5DFFC 0%, #fff 100%);">
            <div class="lqd-shape lqd-shape-top" data-negative="false">
                <svg class="lqd-custom-shape -rotate-180 h-220" fill="none" height="461"
                    preserveaspectratio="none" viewbox="0 0 1440 461" width="1440"
                    xmlns="http://www.w3.org/2000/svg">
                    <path class="lqd-shape-fill"
                        d="m0 131.906 34.4-20.017c34.4-19.9 103.2-59.936 171.68-82.979 68.64-23.043 136.8-29.328003 205.44-4.306 68.48 25.022 137.28 81.35 205.76 80.768 68.64-.582 136.8-58.074 205.44-84.608 68.48-26.535 137.28-22.345 205.76-16.06 68.64 6.168 136.8 14.315 205.44 22.811 68.48 8.612 137.28 17.457 171.68 22l34.4 4.422v396.851h-1440z"
                        fill="#fff" fill-opacity=".09">
                        <animate attributename="d" dur="10s" fill="freeze" repeatcount="indefinite"
                            values="M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z; M0 122.906L36.5 109C71.5 96.372 102.52 67.98 171 44.937C239.64 21.894 354.36 51.478 423 76.5C491.48 101.522 546.52 19.097 615 18.515C683.64 17.933 799.36 58.534 868 32C936.48 5.46499 1039.52 54.715 1108 61C1176.64 67.168 1190.36 -6.996 1259 1.5C1327.48 10.112 1371.2 35.972 1405.6 40.515L1440 44.937V441.788H0L0 122.906Z; M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M0 154.75L34.4 142.201C68.8 129.53 137.6 104.433 206.08 99.072C274.72 93.833 342.88 108.453 411.52 122.099C480 135.622 548.8 148.293 617.28 142.811C685.92 137.329 754.08 113.693 822.72 113.693C891.2 113.693 960 137.329 1028.48 152.68C1097.12 168.153 1165.28 175.463 1233.92 184.966C1302.4 194.591 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z"
                        fill="#fff" fill-opacity=".28">
                        <animate attributename="d" dur="8s" fill="freeze" repeatcount="indefinite"
                            values="M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 33.4 177.201 55 176.5C76.6 175.799 137.52 110.361 206 105C274.64 99.761 332.86 141.104 401.5 154.75C469.98 168.273 527.52 206.982 596 201.5C664.64 196.018 747.86 75 816.5 75C884.98 75 956.52 118.149 1025 133.5C1093.64 148.973 1163.36 87.497 1232 97C1300.48 106.625 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M0 340.22L34.4 333.92C68.8 327.52 137.6 314.92 206.08 312.22C274.72 309.52 342.88 316.92 411.52 319.72C480 322.52 548.8 320.92 617.28 318.92C685.92 316.92 754.08 314.52 822.72 316.02C891.2 317.52 960 322.92 1028.48 309.42C1097.12 295.92 1165.28 263.52 1233.92 251.02C1302.4 238.52 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z"
                        fill="#fff">
                        <animate attributename="d" dur="6.5s" fill="freeze" repeatcount="indefinite"
                            values="M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z; M0 340.22L37.5 323C71.9 316.6 137.52 336.62 206 333.92C274.64 331.22 339.86 272.2 408.5 275C476.98 277.8 551.02 304 619.5 302C688.14 300 759.36 266.5 828 268C896.48 269.5 962.02 336.5 1030.5 323C1099.14 309.5 1156.36 232.5 1225 220C1293.48 207.5 1364.1 249.62 1398.5 253.22L1440 253.22V453.22H0L0 340.22Z; M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M1440 337.719L1405.6 340.219C1371.2 342.719 1302.4 347.719 1233.92 350.419C1165.28 353.019 1097.12 353.419 1028.48 352.219C960 351.019 891.2 348.419 822.72 357.019C754.08 365.719 685.92 385.719 617.28 395.919C548.8 406.019 480 406.419 411.52 395.919C342.88 385.419 274.72 364.019 206.08 359.419C137.6 354.719 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z"
                        fill="#fff">
                        <animate attributename="d" dur="5.5s" fill="freeze" repeatcount="indefinite"
                            values="M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1295.98 326.3 1227.5 329C1158.86 331.6 1081.64 391.2 1013 390C944.52 388.8 874.48 364.119 806 372.719C737.36 381.419 675.14 296.3 606.5 306.5C538.02 316.6 471.48 383.219 403 372.719C334.36 362.219 272.64 320.6 204 316C135.52 311.3 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z">
                        </animate>
                    </path>
                </svg>
            </div>
            <div class="container">
                <div class="row items-center">


                </div>
            </div>
        </section>
    </footer>



    <!-- Bootstrap script link -->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelectorAll('.popup-message').forEach(function(el) {
                el.style.display = 'none';
            });
        }, 3000);

        document.querySelectorAll('.tutupsal').forEach(function(btn) {
            btn.addEventListener('click', closeModalAndClearSession);
        });
    });

    function closeModalAndClearSession() {
        // Menghilangkan modal
        document.getElementById('gagal-message').style.display = 'none';

        // Mengirim permintaan HTTP untuk menghapus session
        fetch('/clear-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to clear session');
                }
                // Jika berhasil, perbarui halaman
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

</html>
