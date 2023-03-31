<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="{{ asset('/main.js') }}"></script>
<script src="{{ asset('/Jquery.js') }}"></script>


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Tarjeta del usuario -->
            <div class="data-profile">
                @if($user->image)
                <div class="container-profile">
                    <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="profile-avatar">
                </div>
                @endif

                <div class="user-info">
                    <h1>{{ '@' . $user->nick}}</h1>
                    <h2>{{ $user->name . '' . $user->surname }}</h2>
                    <span>{{'se unió ' . \FormatTime::LongTimeFilter($user->created_at) }}</span>
                </div>
            </div>
            <hr>
            @foreach($user->images as $image)
            <!-- Tarjeta de una publicación -->
            @include('includes.image',['image' => $image])
            @endforeach

        </div>

    </div>
</div>
@endsection