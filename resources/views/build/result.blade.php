@extends("layouts.main")

@section("unique-css")
    <link href="{{ asset('css/gallery.css') }}" type="text/css" rel="stylesheet">
@endsection

@section("title", "Search Results")

@section("content")
<div class="block">
    <div id="heading">
        <h4>
            Search Results
        </h4>
    </div>

<div class="gallery" id="new-gallery">
    @if (count($builds) == 0)
        <p>There were no builds with your specifications.</p>
    @else
    @foreach($builds as $build)
    <div class="gallery-box" data-bs-toggle="modal" data-bs-target="#build-{{$build->id}}">
        @if (Auth::check())
            <form action="{{ route('favorite.store', ['id' => $build->id]) }}" method="POST" target="_blank">
            @csrf
                <button type="submit" class="btn button button-link button-heart">
                        <i class="fa fa-heart fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan

        @can('update', $build)
            <form action="{{ route('build.edit', ['id' => $build->id]) }}" method="GET">
            @csrf
                <button type="submit" class="btn button button-link button-pen">
                    <i class="fa fa-pen fa-2xl fa-bounce"></i>
                </button>
            </form>
        @endcan
        <div class="img-container">
            <img src="{{$build->img_link}}" alt="{{$build->creator_name}}'s build">
        </div>
        <div class="info-container">
            @if(!$build->created_at)
                <p>Date: N/A</p>
            @else()
                <p>{{ date_format($build->updated_at, 'n/j/Y') }}</p>
            @endif
            @if ($build->theme->id == 1)
                <p class="red">
            @elseif ($build->theme->id == 2)
                <p class="orange">
            @elseif ($build->theme->id == 3)
                <p class="yellow">
            @elseif ($build->theme->id == 4)
                <p class="green">
            @elseif ($build->theme->id == 5)
                <p class="lightblue">
            @elseif ($build->theme->id == 6)
                <p class="darkblue">
            @elseif ($build->theme->id == 7)
                <p class="purple">
            @elseif ($build->theme->id == 8)
                <p class="pink">
            @endif
            {{$build->theme->theme}}</p>
        </div>
    </div>

    <div class="modal fade" id="build-{{$build->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
        {{-- {{$build->creator_name}}- --}}
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3>Build by 
                    <a href="{{$build->creator_link}}" target="_blank">
                        {{$build->creator_name}}
                    </a>
                </h3>

                <p class="submitted-by">Submitted by <a href="{{ route('profile.other', ['id' => $build->user->id]) }}">{{$build->user->username}}</a></p>

                <img src="{{$build->img_link}}" alt="{{$build->creator_name}}'s build">

                <p class="description">{{$build->description}}</p>

                <div class="build-tags">
                    <p>{{ $build->category->category }}</p>
                    <p>{{ $build->theme->theme }}</p>
                    <p>{{ $build->season->season }}</p>
                </div>

                <div class="comments-container">
                    @if (Auth::check())
                    <form action="{{ route('comment.store', ['id' => $build->id]) }}" method="POST">
                        @csrf
                        <div>
                            <textarea class="form-control" id="comment" type="text" name="comment">{{ old('comment') }}</textarea>
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
                        @if ($comment->build_id == $build->id)
                            <div class="comment">
                                <h6>{{ $comment->user->username }}</h6>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <p class="comment-date">Posted on {{ date_format($comment->updated_at, 'n/j/Y') }} at {{ date_format($comment->updated_at, 'g:i A') }}</p>

                                @canany(['update', 'delete'], $comment)
                                <div class="comment-form">
                                    <form action="{{ route('comment.edit', ['id' => $comment->id]) }}" method="GET">
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
                    <form action="{{ route('favorite.store', ['id' => $build->id]) }}" method="POST" target="_blank">
                    @csrf
                        <button type="submit" class="btn button button-link">Favorite</button>
                    </form>
                    @endif

                    @canany(['update', 'delete'], $build)
                    <form action="{{ route('build.edit', ['id' => $build->id]) }}" method="GET">
                    @csrf
                        <button type="submit" class="btn button button-link">Edit</button>
                    </form>

                    <form action="{{ route('build.delete', ['id' => $build->id]) }}" method="POST">
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
@endsection