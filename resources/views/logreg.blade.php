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
@elseif ($errors->has('image'))
    <div class="modal-sal" id="error-message">
        <i class="fa-solid fa-circle-exclamation"></i>
        <h2>Gagal</h2>
        <h3>{{ $errors->first('image') }}</h3>
        <div class="butsal">
            <button class="tutupsal" onclick="closeclose()">OK</button>
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
                    <small id="password-error" style="display: none;">Password harus minimal 8 karakter</small>
                </form>







                {{-- register --}}
                <form action="{{ route('user.store') }}" class="sign-up-form" method="POST"
                    enctype="multipart/form-data" id="signup-form">
                    @csrf
                    <h2 class="title">Register</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nama Lengkap" name="name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" id="email" required />
                        <small id="email-error" style="display: none;">Pastikan email mengandung karakter '@'</small>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" id="password" required />

                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Konfirmasi Password" name="password_confirmation"
                            id="confirm-password" required />

                    </div>
                    <div class="input-field">
                        <i class="fas fa-image"></i>
                        <input type="file" placeholder="Image" name="image" id="image" accept="image/*"
                            >

                    </div>

                    <input type="submit" name="submit" class="btnsig" value="Sign up" />
                    <small id="password-error" style="display: none;">Password harus minimal 8 karakter</small>
                    <small id="confirm-password-error" style="display: none;">Konfirmasi password harus sama dengan
                        password</small>
                    <small id="image-error" style="display: none;">Ukuran gambar terlalu besar maksimal 2MB</small>
                </form>




            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Login dan bergabung bersama E-library</h3>
                    <p>
                        Belum memiliki akun E-library? Klik tombol dibawah!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Daftar Sekarang
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Selamat datang di E-library!</h3>
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
    <script>
        const form = document.getElementById('signup-form');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('confirm-password');
        const imageField = document.getElementById('image');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');
        const imageError = document.getElementById('image-error');

        form.addEventListener('submit', function(event) {
            if (!emailField.value.includes('@')) {
                event.preventDefault();
                emailError.style.display = 'block';
            } else {
                emailError.style.display = 'none';
            }

            if (passwordField.value.length < 8) {
                event.preventDefault();
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }

            if (passwordField.value !== confirmPasswordField.value) {
                event.preventDefault();
                confirmPasswordError.style.display = 'block';
            } else {
                confirmPasswordError.style.display = 'none';
            }

            if (imageField.files[0].size > 2048 * 1024) {
                event.preventDefault();
                imageError.style.display = 'block';
            } else {
                imageError.style.display = 'none';
            }
        });
    </script>

</body>

</html>
