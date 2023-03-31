<div class="card">
    <div class="card-header">

        @if($image->user->image)
        <div class="container-avatar">
            <img class="pub_image" src="{{ route('user.avatar',['filename' => $image->user->image]) }}">
        </div>
        @endif

        <div class="text_surname">
            <a href="{{ route('profile',['id' => $image->user->id]) }}">
                {{ $image->user->name . ' ' . $image->user->surname }}
                <span class="text_nick">{{ ' | @' . $image->user->nick }}</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
        </div>
    </div>

    <div class="description">
        <span class="text_nick">{{'@' . $image->user->nick }}</span>
        <span>{{' | ' . \FormatTime::LongTimeFilter($image->created_at) }}</span>

        <p>{{ $image->description }}</p>
        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-warning">
            Comentarios ({{ count($image->comments) }})
        </a>

        <!-- Comprobar si el usuario le dió like a la imagen -->
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
    </div>

</div>