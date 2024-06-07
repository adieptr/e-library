<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/lupas.css') }}" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">
</head>
    <title>Verifikasi</title>
</head>
@if (session('success'))
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


@if (session('success'))
    <div class="modal-box" id="success-message">
        <i class="fa-solid fa-check-to-slot"></i>
        <h2>Success</h2>
        <h3>{{ session('success') }}</h3>
        <div class="but">
            <button class="tutupbut" onclick="closeModalAndClearSession()">OK</button>
        </div>
    </div>
    @elseif (session('error'))
        <div id="error-message" class="popup-message">{{ session('error') }}</div>
    @endif


    @if (session('sucesup'))
    <div class="modal-up" id="success-message">
        <i class="fa-solid fa-thumbs-up"></i>
        <h2>Success</h2>
        <h3>{{ session('sucesup') }}</h3>
        <div class="butup">
            <button class="tutupbutup" onclick="closeModalAndClearSession()">OK</button>
        </div>
    </div>
    @elseif (session('errorup'))
        <div id="error-message" class="popup-message">{{ session('error') }}</div>
    @endif


<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form  method="POST" action="{{ route('sendmail') }}" class="sign-in-form" id="email-form">
                    @csrf
                    <h2 class="title">Verikasi Email Password</h2>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" name="email" required id="email" />
                    </div>
                    <button type="submit" class="btn solid">Kirim</button>

                    {{-- <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" required id="otp_inp" placeholder="Masukkan kode OTP..." />
                    </div> --}}
                </form>
                {{-- <button onclick="verifyOTP(event)" class="buttonverif" id="otp-btn">Verifikasi</button> --}}
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Ikuti langkah berikut untuk mereset password Anda</h3>
                    <p>
                    <ul class="ull" style="text-align: left">
                        <li>Masukkan alamat email yang ingin Anda ubah password</li>
                        <li>Klik KIRIM OTP untuk mendapatkan kode OTP yang dikirim ke email Anda</li>
                        <li>Cek email Anda, lalu masukkan kode OTP yang telah kami kirim di kolom pengisian kode OTP
                        </li>
                        <li>Klik VERIFIKASI untuk masuk ke halaman selanjutnya</li>
                    </ul>
                    </p>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="lupas.js"></script>
</body>

</html>
