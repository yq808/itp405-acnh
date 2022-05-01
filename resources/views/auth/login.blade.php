@extends("layouts.main")

@section("title", "Login")

@section("content")

@if (session('error'))
<div class="alert alert-warning" role="alert">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('auth.login') }}" method="POST" id="narrow-form">
    @csrf
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