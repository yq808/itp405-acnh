@extends("layouts.main")

@section("title", "Register")

@section("content")

<form action="{{ route('register.create') }}" method="POST">
    @csrf
    <div>
        <label class="form-label" for="username"> Username </label>
        <input class="form-control" id="username" type="text" name="username" placeholder="tommytrojan">
    </div>
    <div>
        <label class="form-label" for="email"> Email </label>
        <input class="form-control" id="email" type="text" name="email" placeholder="ttrojan@usc.edu">
    </div>
    <div>
        <label class="form-label" for="password"> Password </label>
        <input class="form-control" id="password" type="password" name="password">
    </div>

    <button type="submit" class="btn button"> Submit </button>
    <button type="reset" class="btn button"> Reset </button>
</form>

@endsection