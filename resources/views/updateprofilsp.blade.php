@extends('components.spheader')
@section('main')
<link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
{{-- <script src="{{ asset('assets/js/admin_script.js') }}"></script> --}}

<header class="header">

    <section class="flex">

        <a href="{{ url('/dashboardsp') }}" class="logo">Admin</a>
{{--
        <form action="{{ route('detailsiswa.carisiswadalam') }}" method="post" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="Cari Siswa..." required maxlength="100">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form> --}}

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

            <a href="{{ route('logoutsp') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"
            class="delete-btn">Log out</a>

        </div>

    </section>

</header>

<section class="form-container" style="min-height: calc(100vh - 19rem);">

    <form action="{{ route('tutors.updatesp', $tutor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
       <h3>Update Profile Admin</h3>
       <<div class="flex">
        <div class="col">
           <p>Nama Anda : </p>
           <input type="text" name="name" placeholder="{{ $tutor->name }}" maxlength="100"  class="box">
           <p>Profesi Anda :</p>
           <input type="text" name="profession" placeholder="{{ $tutor->profession }}" maxlength="100"  class="box">
           {{-- <select name="profession" class="box">
              <option value="" selected>{{ $tutor->profession }}</option>
              <option value="developer">developer</option>
              <option value="desginer">designer</option>
              <option value="musician">musician</option>
              <option value="biologist">biologist</option>
              <option value="teacher">teacher</option>
              <option value="engineer">engineer</option>
              <option value="lawyer">lawyer</option>
              <option value="accountant">accountant</option>
              <option value="doctor">doctor</option>
              <option value="journalist">journalist</option>
              <option value="photographer">photographer</option>
           </select> --}}
           <p>Email Anda :</p>
           <input type="email" name="email" placeholder="{{ $tutor->email }}" maxlength="100"  class="box">
        </div>
        <div class="col">
           <p>Password Lama :</p>
           <input type="password" name="old_pass" placeholder="enter your old password" maxlength="20"  class="box">
           <p>Password Baru :</p>
           <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box">
           <p>Konfirmasi Password :</p>
           <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box">
        </div>
     </div>
     <p>uUnggah Foto Profil </p>
     <input type="file" name="image" accept="image/*"  class="box">
     <input type="submit" name="submit" value="update now" class="btn">
    </form>

 </section>
@endsection
