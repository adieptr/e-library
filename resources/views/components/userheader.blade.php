<!-- <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student ({{ $userName }})</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="{{ asset('assets/css/dash.css') }}">
   <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">

</head>
<body>

<header class="header">
   <section class="flex">
      <a href="{{ route('courses.index') }}" class="logo">Student</a>



      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
         <h3>{{ $userName }}</h3>
         <span>Student</span>
         <a href="{{ url('/profileuser') }}" class="btn">View Profile</a>
         {{-- <div class="flex-btn">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div> --}}
         <a href="{{ route('logoutsiswa') }}" onclick="return confirm('Anda Yakin Ingin Logout?');" class="delete-btn">Logout</a>

         {{-- <h3>Please login or register</h3>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div> --}}

      </div>
   </section>
</header>

<!-- Sidebar section starts  -->
<div class="side-bar">
   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">

      <img src="{{ asset('uploaded_files/' . $userImage) }}" alt="">
      <h3>{{ $userName }}</h3>
      <span>Student</span>
      <a href="{{ url('/profileuser') }}" class="btn">View Profile</a>
      <a href="{{ url('/dashboarduser') }}" class="btn">Landing Page</a>
      {{-- <h3>Please login or register</h3>
      <div class="flex-btn" style="padding-top: .5rem;">
         <a href="login.php" class="option-btn">Login</a>
         <a href="register.php" class="option-btn">Register</a>
      </div> --}}

   </div>

   <nav class="navbar">
      {{-- <a href="{{ url('/dashboarduser') }}"><i class="fas fa-home"></i><span>Home</span></a> --}}
      <a href="{{ route('courses.index') }}"><i class="fas fa-graduation-cap"></i><span>Kursus Saya</span></a>
      <a href="{{ route('courses.riwayatkur') }}"><i class="fas fa-graduation-cap"></i><span>Riwayat Kursus</span></a>
      <a href="{{ route('pages.game') }}"><i class="fa-solid fa-gamepad"></i></i><span>Games</span></a>
      <a href="https://wa.me/6285707038940"><i class="fas fa-headset"></i><span>Pusat Bantuan</span></a>
      <a href="{{ route('logoutsiswa') }}" onclick="return confirm('Anda Yakin Ingin Log out?');"><i class="fas fa-right-from-bracket"></i><span>Log out</span></a>

   </nav>
</div>
<!-- Sidebar section ends -->

<main>
   @yield('main')
</main>
<script src="{{ asset('assets/js/user_script.js') }}"></script>
</body>
</html>
