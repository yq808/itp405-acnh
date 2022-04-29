@extends("layouts.main")

@section("title", "Home")

@section("content")

<div class="block">
    <h4>
        Newest in...
    </h4>

    <div class="gallery" id="new-gallery">

        @foreach($builds as $build)
        <div class="gallery-box" data-bs-toggle="modal" data-bs-target="#{{$build->creator_name}}-{{$build->id}}">
            <p class="fa fa-heart fa-2xl fa-bounce"></p>
            <div class="img-container">
                <img src="{{$build->img_link}}" alt="{{$build->creator_name}}'s build">
            </div>
            <div class="info-container">
                <p>{{$build->created_at}}</p>
                <p>{{$build->theme->theme}}</p>
            </div>
        </div>

        <div class="modal fade" id="{{$build->creator_name}}-{{$build->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
                        <div class="comment">
                            <h6>username</h6>
                            <p>here is a sample comment! wow i really love this design. i think i'll use it for my island as well.</p>
                            <p class="comment-date">Posted on 2/3/2022</p>
                        </div>
                        <div class="comment">
                            <h6>username</h6>
                            <p>here is a sample comment! wow i really love this design. i think i'll use it for my island as well.</p>
                            <p class="comment-date">Posted on 2/3/2022</p>
                        </div>
                        <div class="comment">
                            <h6>username</h6>
                            <p>here is a sample comment! wow i really love this design. i think i'll use it for my island as well.</p>
                            <p class="comment-date">Posted on 2/3/2022</p>
                        </div>
                    </div>

                    <button class="btn">Button</button>
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