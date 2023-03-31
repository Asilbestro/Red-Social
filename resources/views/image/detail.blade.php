<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            @include('includes.message')

            <div class="card">
                <div class="card-header">

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img class="pub_image" src="{{ route('user.avatar',['filename' => $image->user->image]) }}">
                    </div>
                    @endif

                    <div class="text_surname">
                        {{ $image->user->name . ' ' . $image->user->surname }}
                        <span class="text_nick">{{ ' | @' . $image->user->nick }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                    </div>
                </div>

                <div class="description">
                    <span class="text_nick">{{'@' . $image->user->nick }}</span>
                    <span>{{' | ' . \FormatTime::LongTimeFilter($image->created_at) }}</span>

                    <p>{{ $image->description }}</p>
                    <div class="comments">

                        <!-- Botones de acciones -->
                        @if(Auth::user() && Auth::user()->id == $image->user_id)
                        <div class="actions">
                            <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a>
                        </div>
                        @endif

                        <div class="likes">

                            <?php $user_like = false ?>
                            @foreach ($image->likes as $like)
                            @if($like->user_id == Auth::user()->id)
                            <?php $user_like = true ?>
                            @endif
                            @endforeach

                            @if($user_like)
                            <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike">
                            @else
                            <img src="{{ asset('img/heart-black.png') }}" data-id="{{ $image->id }}" class="btn-like">
                            @endif
                            <span class="count-likes">{{ count($image->likes) }}</span>
                        </div>
                        <h4>Comentarios ({{ count($image->comments) }})</h4>
                        <hr>

                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" required></textarea>
                                @if($errors->has('content'))
                            <div class="clearfix"></div>
                            <span class="alert alert-danger col-4 alerta-coment" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                            </p>
                            <button type="submit" class="btn btn-success">
                                Enviar
                            </button>
                        </form>

                        <hr>
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <span class="text_nick">{{'@' . $comment->user->nick }}</span>
                            <span>{{' | ' . \FormatTime::LongTimeFilter($comment->created_at) }}</span>

                            <p>{{ $comment->content }}</p>

                            <!-- Eliminar comentario -->
                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                Eliminar
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection