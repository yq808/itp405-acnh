@extends("layouts.main")

@section("unique-css")
    <link href="{{ asset('css/profile.css') }}" type="text/css" rel="stylesheet">
@endsection

@section("title")
    {{ $user->username }}'s Profile
@endsection

@section("content")

<div id="gallery-container">
    <div id="heading">
        <h4>
            Your Posts
        </h4>
    </div>
    <h6 class="capsule">
        Total Posts: {{ count($isCreators) }}
    </h6>
<div class="gallery" id="profile-gallery">
    @foreach($isCreators as $isCreator)
    <div class="gallery-box" data-bs-toggle="modal" data-bs-target="#build-{{$isCreator->id}}">
        @if (Auth::check())
            <form action="{{ route('favorite.store', ['id' => $isCreator->id]) }}" method="POST" target="_blank">
                <button type="submit" class="btn button button-link button-heart">
                        <i class="fa fa-heart fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan

        @can('update', $isCreator)
            <form action="{{ route('build.edit', ['id' => $isCreator->id, 'url' => URL::current()]) }}" method="GET">
                <button type="submit" class="btn button button-link button-pen">
                    <i class="fa fa-pen fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan
        <div class="img-container">
            <img src="{{ $isCreator->img_link }}" alt="{{$isCreator->creator_name}}'s build">
        </div>
        <div class="info-container">
            @if(!$isCreator->created_at)
                <p>Date: N/A</p>
            @else()
                <p>{{$isCreator->created_at}}</p>
            @endif
            @if ($isCreator->theme->id == 1)
                <p class="red">
            @elseif ($isCreator->theme->id == 2)
                <p class="orange">
            @elseif ($isCreator->theme->id == 3)
                <p class="yellow">
            @elseif ($isCreator->theme->id == 4)
                <p class="green">
            @elseif ($isCreator->theme->id == 5)
                <p class="lightblue">
            @elseif ($isCreator->theme->id == 6)
                <p class="darkblue">
            @elseif ($isCreator->theme->id == 7)
                <p class="purple">
            @elseif ($isCreator->theme->id == 8)
                <p class="pink">
            @endif
            {{$isCreator->theme->theme}}</p>
        </div>
    </div>

    <div class="modal fade" id="build-{{$isCreator->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
        {{-- {{$build->creator_name}}- --}}
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3>Build by 
                    <a href="{{$isCreator->creator_link}}" target="_blank">
                        {{$isCreator->creator_name}}
                    </a>
                </h3>

                <img src="{{ $isCreator->img_link }}" alt="{{$isCreator->creator_name}}'s build">

                <p>Submitted by {{$isCreator->user->username}}</p>

                <p>{{$isCreator->description}}</p>

                <div class="comments-container">
                    @if (Auth::check())
                    <form action="" method="POST">
                        <div>
                            <textarea class="form-control" id="comment" type="text" name="comment" placeholder=""></textarea>
                        </div>

                        <button type="submit" class="btn button"> Comment </button>
                    </form>
                    @else
                    <p>Want to leave a comment? <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register.create') }}">register</a> first!</p>
                    @endif
                    @foreach($comments as $comment)
                        @if ($comment->build_id == $isCreator->id)
                            <div class="comment">
                                <h6>{{ $comment->user->username }}</h6>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="comment-date">Posted on 2/3/2022</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <button class="btn button-link">Button</button>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
</div>

<div id="profile-info">
    <div class="profile-img">
        <img src="{{ asset('img/gyroid.png')}}" alt="">
    </div>

    <h4>{{ $user->username }}</h4>

    <p>{{ $user->email }}</p>

    <a href="{{ route('profile.index') }}">Your Posts <span class="capsule">{{ count($isCreators) }}</span></a>
    <a href="{{ route('favorite.index') }}">Favorites <span class="capsule">{{ $favorites }}</span></a>

    <form method="POST" action="{{ route('auth.logout') }}">
        @csrf
        <button type="submit" class="btn button-link" id="logout">&#8594; Logout</button>
    </form>
</div>
@endsection