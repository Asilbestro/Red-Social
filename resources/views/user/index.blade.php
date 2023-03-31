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
            <h1>Usuarios</h1>
            <form action="{{ route('user.index') }}" method="GET" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>
            <hr>

            @foreach($users as $user)
            <!-- Tarjeta de usuario -->
            <div class="data-gente">
                @if($user->image)
                <div class="container-gente">
                    <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="profile-avatar">
                </div>
                @endif

                <div class="user-info-gente">
                    <h2 class="nick-gente">{{ '@' . $user->nick}}</h2>
                    <p class="name-gente">{{ $user->name . '' . $user->surname }}</p>
                    <span>{{'se unió ' . \FormatTime::LongTimeFilter($user->created_at) }}</span>
                    <div class="clearfix"></div>
                    <br>
                </div>
                <div></div>

            </div>
            <a href="{{ route('profile',['id' => $user->id]) }}" class="btn btn-success go-perfil">Ver perfil</a>
            <hr>
            @endforeach

        </div>

    </div>
</div>
@endsection

