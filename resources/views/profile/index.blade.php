@extends("layouts.main")

@section("title")
    {{ $user->username }}'s Profile
@endsection

@section("content")
<div id="gallery-container">
    <p>
        Total Posts: 99
    </p>
<div class="gallery" id="new-gallery">
    <div class="gallery-box">
        <p class="fa fa-pen-clip fa-2xl fa-bounce"></p>
        <div class="img-container">
            <img src="img/figstreet.jpeg" alt="">
        </div>
        <div class="info-container">
            <p>Date</p>
            <p>Theme</p>
        </div>
    </div>
    <div class="gallery-box">
        <p class="fa fa-pen-clip fa-2xl"></p>
        <div class="img-container">
            <img src="img/figstreet.jpeg" alt="">
        </div>
        <div class="info-container">
            <p>Date</p>
            <p>Theme</p>
        </div>
    </div>
    <div class="gallery-box">
        <p class="fa fa-pen-clip fa-2xl"></p>
        <div class="img-container">
            <img src="img/figstreet.jpeg" alt="">
        </div>
        <div class="info-container">
            <p>Date</p>
            <p>Theme</p>
        </div>
    </div>
    <div class="gallery-box">
        <p class="fa fa-pen-clip fa-2xl"></p>
        <div class="img-container">
            <img src="img/figstreet.jpeg" alt="">
        </div>
        <div class="info-container">
            <p>Date</p>
            <p>Theme</p>
        </div>
    </div>
</div>
</div>

<div id="profile-info">
    <div class="profile-img">
        <img src="img/gyroid.png" alt="">
    </div>

    <h5>{{ $user->username }}</h5>

    <p>{{ $user->email }}</p>

    <a href="">Your Posts</a>
    <a href="">Favorites</a>

    <a href="" id="logout">&#8594; Logout</a>
</div>
@endsection