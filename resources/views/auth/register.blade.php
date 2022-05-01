@extends("layouts.main")

@section("title", "Register")

@section("content")

<form action="{{ route('register.create') }}" method="POST" id="narrow-form">
    <p>Already have an account? Please <a href="{{ route('login') }}">login</a>.</p>
    @csrf
    <div>
        <label class="form-label" for="username"> Username </label>
        <input class="form-control" id="username" type="text" name="username" placeholder="tommytrojan" value="{{ old('username') }}">
        @error("username")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div>
        <label class="form-label" for="email"> Email </label>
        <input class="form-control" id="email" type="text" name="email" placeholder="ttrojan@usc.edu" value="{{ old('email') }}">
        @error("email")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div>
        <label class="form-label" for="password"> Password </label>
        <input class="form-control" id="password" type="password" name="password">
        @error("password")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <button type="submit" class="btn button"> Submit </button>
    <button type="reset" class="btn button"> Reset </button>
</form>

@endsection