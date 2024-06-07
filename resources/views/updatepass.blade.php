<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/loginregis.css" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
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


<body>
    <script src="lupas.js"></script>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('updatePassword') }}" class="sign-in-form" method="POST">
                    @csrf
                    <h2 class="title">Update Password</h2>

                    @if (isset($message))
                        <div class="message form">
                            <span>{{ $message }}</span>
                            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                        </div>
                    @endif

                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="email" placeholder="Email" name="email" required id="email" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="password" name="password" required placeholder="Password" />
                        </div>
                        <button type="submit" class="btn solid">Ubah</button>
                </form>







                {{-- register --}}

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Update Password Baru</h3>
                    <p>
                        Masukkan Email Yang sama dengan Email yang Kamu Gunakan Untuk Verifikasi Tadi, Isi Password Form Lalu Klik Kirim
                    </p>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            {{-- <div class="panel right-panel">
          <div class="content">
            <h3>Lorem, ipsum dolor.</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Login
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div> --}}
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
