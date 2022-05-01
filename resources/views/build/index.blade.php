@extends("layouts.main")

@section("unique-css")
    <link href="{{ asset('css/index.css') }}" type="text/css" rel="stylesheet">
@endsection

@section("title", "Home")

@section("content")

<div class="block">
    <div id="heading">
        <h4>
            Newest in...
        </h4>
    </div>

    <div class="gallery" id="new-gallery">
        {{-- {{ URL::current() }}
        {{ Route::current()->getName() }} --}}

        @foreach($builds as $build)
        <div class="gallery-box" data-bs-toggle="modal" data-bs-target="#build-{{$build->id}}">
            @if (Auth::check())
                <form action="{{ route('favorite.store', ['id' => $build->id]) }}" method="POST" target="_blank">
                    <button type="submit" class="btn button button-link button-heart">
                            <i class="fa fa-heart fa-2xl fa-bounce"></i>
                    </button>
                </form>
            @endcan

            @can('update', $build)
                <form action="{{ route('build.edit', ['id' => $build->id, 'url' => URL::current()]) }}" method="GET">
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
                    <p>{{$build->created_at}}</p>
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

                    <img src="{{$build->img_link}}" alt="{{$build->creator_name}}'s build">

                    <p>Submitted by {{$build->user->username}}</p>

                    <p>{{$build->description}}</p>

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
                            @if ($comment->build_id == $build->id)
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

<div class="block">
<div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="https://pbs.twimg.com/media/FDfJ1TnaAAABekB?format=jpg&name=large" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
        <img src="https://pbs.twimg.com/media/FBGtajOVcAM_m3B?format=jpg&name=large" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
        <img src="https://pbs.twimg.com/media/ErD6MwoXAAIQoEB?format=jpg&name=large" class="d-block w-100" alt="">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</div>

<div class="about">
    <div>
        <div id="img-div">
        </div>
    </div>
    <div id="text">
        <p>FIND INSPIRATION</p>
        <h4>What's this?</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc urna nisi, consequat sed ultricies sit amet, euismod sed mi. Fusce finibus libero a nisi pretium convallis. Donec fringilla lectus ac lacus ornare, ac ultrices nulla imperdiet. Curabitur enim mi, lobortis vel vestibulum eu, pulvinar sed elit.</p>
        <a href=""></a>
    </div>
</div>

@endsection