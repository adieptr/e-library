@extends('components.userheader')
@section('main')
<link rel="stylesheet" href="assets/css/dash.css">
<section class="profile">

    <h1 class="heading">Profile Details</h1>

    <div class="details">

       <div class="user">
          <img src="{{ asset('uploaded_files/' . $userImage) }}">
          <h3>{{ $userName }}</h3>
          <p>Student</p>
          <a href="{{ route('user.edit', $userId) }}" class="inline-btn">Update Profile</a>
       </div>

       {{-- <div class="box-container">

          <div class="box">
             <div class="flex">
                <i class="fas fa-bookmark"></i>
                <div>
                   <h3></h3>
                   <span>saved playlists</span>
                </div>
             </div>
             <a href="#" class="inline-btn">view playlists</a>
          </div>

          <div class="box">
             <div class="flex">
                <i class="fas fa-heart"></i>
                <div>
                   <h3></h3>
                   <span>liked tutorials</span>
                </div>
             </div>
             <a href="#" class="inline-btn">view liked</a>
          </div>

          <div class="box">
             <div class="flex">
                <i class="fas fa-comment"></i>
                <div>
                   <h3></h3>
                   <span>video comments</span>
                </div>
             </div>
             <a href="#" class="inline-btn">view comments</a>
          </div>

       </div> --}}

    </div>

 </section>
@endsection
