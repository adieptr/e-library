@extends('components.userheader')
@section('main')

<section class="courses">

    <h1 class="heading">Game</h1>

    <div class="box-container">


        <div class="box">
            <a href="{{ route('pages.tictac') }}"><img src="assets/images/tictac.png" class="thumb" alt=""></a>
            <h3 class="title">TicTacToc Game</h3>
            <a href="{{ route('pages.tictac') }}" class="inline-btn">Mainkan</a>
        </div>
        <div class="box">
           <a href="{{ route('pages.cardlv1') }}"> <img src="assets/images/memory.png" class="thumb" alt=""></a>
            <h3 class="title">Memory Card Eazy</h3>
            <a href="{{ route('pages.cardlv1') }}" class="inline-btn">Mainkan</a>
        </div>
        <div class="box">
            <a href="{{ route('pages.batu') }}"><img src="assets/images/batu.png" class="thumb" alt=""></a>
            <h3 class="title">Batu Gunting Kertas</h3>
            <a href="{{ route('pages.batu') }}" class="inline-btn">Mainkan</a>
        </div>
        <div class="box">
            <a href="{{ route('pages.ular') }}"><img src="assets/images/ular.png" class="thumb" alt=""></a>
            <h3 class="title">Ular Classic</h3>
            <a href="{{ route('pages.ular') }}" class="inline-btn">Mainkan</a>
        </div>
        <div class="box">
            <a href="{{ route('pages.gambar') }}"><img src="assets/images/gambar.png" class="thumb" alt=""></a>
            <h3 class="title">Mari Menggambar</h3>
            <a href="{{ route('pages.gambar') }}" class="inline-btn">Mainkan</a>
        </div>
        <div class="box">
            <a href="{{ route('pages.ninja') }}"><img src="assets/images/ninja.png" class="thumb" alt=""></a>
            <h3 class="title">Fruit Ninja</h3>
            <a href="{{ route('pages.ninja') }}" class="inline-btn">Mainkan</a>
        </div>



    </div>

</section>



@endsection
