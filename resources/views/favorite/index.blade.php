@extends("layouts.main")

@section("unique-css")
    <link href="{{ asset('css/profile.css') }}" type="text/css" rel="stylesheet">
@endsection

@section("title")
    {{ Auth::user()->username }}'s Favorites
@endsection

@section("content")

<div id="gallery-container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div id="heading">
        <h4>
            Favorites
        </h4>
    </div>
    <h6 class="capsule">
        Total Posts: {{ count($favorites) }}
    </h6>
<div class="gallery" id="profile-gallery">
    @if(count($favorites) == 0)
        <p>It looks like you don't have any favorites yet! <a href="{{ route('build.index') }}">Browse</a>.</p>
    @else
    @foreach($favorites as $favorite)
    <div class="gallery-box" data-bs-toggle="modal" data-bs-target="#build-{{$favorite->build->id}}">
        @if (Auth::check())
            <form action="{{ route('favorite.delete', ['id' => $favorite->id]) }}" method="POST">
            @csrf
                <button type="submit" class="btn button button-link button-heart">
                        <i class="fa-solid fa-heart-crack fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan

        @can('update', $favorite)
            <form action="{{ route('build.edit', ['id' => $favorite->build->id]) }}" method="GET">
            @csrf
                <button type="submit" class="btn button button-link button-pen">
                    <i class="fa fa-pen fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan
        <div class="img-container">
            <img src="{{ $favorite->build->img_link }}" alt="{{$favorite->build->creator_name}}'s build">
        </div>
        <div class="info-container">
            @if(!$favorite->build->updated_at)
                <p>Date: N/A</p>
            @else()
                <p>{{ date_format($favorite->build->updated_at, 'n/j/Y') }}</p>
            @endif
            @if ($favorite->build->theme->id == 1)
                <p class="red">
            @elseif ($favorite->build->theme->id == 2)
                <p class="orange">
            @elseif ($favorite->build->theme->id == 3)
                <p class="yellow">
            @elseif ($favorite->build->theme->id == 4)
                <p class="green">
            @elseif ($favorite->build->theme->id == 5)
                <p class="lightblue">
            @elseif ($favorite->build->theme->id == 6)
                <p class="darkblue">
            @elseif ($favorite->build->theme->id == 7)
                <p class="purple">
            @elseif ($favorite->build->theme->id == 8)
                <p class="pink">
            @endif
            {{$favorite->build->theme->theme}}</p>
        </div>
    </div>

    <div class="modal fade" id="build-{{$favorite->build->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
        {{-- {{$build->creator_name}}- --}}
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3>Build by 
                    <a href="{{$favorite->build->creator_link}}" target="_blank">
                        {{$favorite->build->creator_name}}
                    </a>
                </h3>

                <p class="submitted-by">Submitted by <a href="{{ route('profile.other', ['id' => $favorite->build->user->id]) }}">{{$favorite->build->user->username}}</a></p>

                <img src="{{ $favorite->build->img_link }}" alt="{{$favorite->build->creator_name}}'s build">

                <p class="description">{{$favorite->build->description}}</p>

                <div class="build-tags">
                    <p>{{ $favorite->build->category->category }}</p>
                    <p>{{ $favorite->build->theme->theme }}</p>
                    <p>{{ $favorite->build->season->season }}</p>
                </div>

                <div class="comments-container">
                    @if (Auth::check())
                    <form action="{{ route('comment.store', ['id' => $favorite->build->id]) }}" method="POST">
                        @csrf
                        <div>
                            <textarea class="form-control" id="comment" type="text" name="comment" placeholder="">{{ old('comment') }}</textarea>
                            @error("comment")
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn button"> Comment </button>
                    </form>
                    @else
                    <p>Want to leave a comment? <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register.create') }}">register</a> first!</p>
                    @endif
                    @foreach($comments as $comment)
                        @if ($comment->build_id == $favorite->build->id)
                            <div class="comment">
                                <h6>{{ $comment->user->username }}</h6>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="comment-date">Posted on {{ date_format($comment->updated_at, 'n/j/Y') }}</p>

                                @canany(['update', 'delete'], $comment)
                                <div class="comment-form">
                                    <form action="{{ route('comment.edit', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn button button-link">Edit</button>
                                    </form>
                                    <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn button button-link">Delete</button>
                                    </form>
                                </div>
                                @endcan
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="modal-buttons">
                    @if (Auth::check())
                    <form action="{{ route('favorite.delete', ['id' => $favorite->id]) }}" method="POST">
                    @csrf
                        <button type="submit" class="btn button button-link">Favorite</button>
                    </form>
                    @endif

                    @canany(['update', 'delete'], $favorite->build)
                    <form action="{{ route('build.edit', ['id' => $favorite->build->id, 'url' => URL::current()]) }}" method="GET">
                    @csrf
                        <button type="submit" class="btn button button-link">Edit</button>
                    </form>

                    <form action="{{ route('build.delete', ['id' => $favorite->build->id, 'url' => URL::current()]) }}" method="POST">
                    @csrf
                        <button type="submit" class="btn button button-link">Delete</button>
                    </form>
                    @endcan
                </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
</div>

<div id="profile-info">
    <div class="profile-img">
        <img src="{{ asset('img/gyroid.png')}}" alt="">
    </div>

    <h4>{{ $user->username }}</h4>

    <p>{{ $user->email }}</p>

    <a href="{{ route('profile.index') }}">Your Posts <span class="capsule">{{ $isCreators }}</span></a>
    <a href="{{ route('favorite.index') }}">Favorites <span class="capsule">{{ count($favorites) }}</span></a>

    <form method="POST" action="{{ route('auth.logout') }}">
        @csrf
        <button type="submit" class="btn button-link" id="logout">&#8594; Logout</button>
    </form>
</div>
@endsection