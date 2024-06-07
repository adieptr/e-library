<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/loginregis.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Login/Register</title>
    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">
</head>
{{-- @if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif --}}



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
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('login') }}" class="sign-in-form" method="POST">
                    @csrf
                    <h2 class="title">Login</h2>

                @if (isset($message))
                <div class="message form">
                    <span>{{ $message }}</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                @endif



                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                    <p class="social-text">Lupa kata sandi Anda? Klik disini
                    <a href="/forgot-password" style="text-decoration: none;">
                        Lupa Password
                    </a>
                </p>
                </form>







                {{-- register --}}
                <form action="{{ route('user.store') }}" class="sign-up-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h2 class="title">Register</h2>
                    @if (session('error'))
                        <div class="message form">
                            <span>{{ session('error') }}</span>
                            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                        </div>
                    @endif
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nama Lengkap" name="name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Konfirmasi Password" name="password_confirmation"
                            required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-image"></i>
                        <input type="file" placeholder="Image" name="image" accept="image/*" required />
                    </div>
                    <input type="submit" name="submit" class="btnsig" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Login dan bergabung bersama Codinggo</h3>
                    <p>
                        Belum memiliki akun Codinggo? Klik tombol dibawah!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Daftar Sekarang
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Selamat datang di Codinggo!</h3>
                    <p>
                        Sudah memiliki akun? Klik tombol dibawah!
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Login
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
