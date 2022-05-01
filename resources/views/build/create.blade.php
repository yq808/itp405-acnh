@extends("layouts.main")

@section("title", "New Build")

@section("content")

<div id="form-div">

<div id="heading">
    <h4>
        Create Build
    </h4>
</div>

<form action="{{ route('build.store') }}" method="POST" id="search-form">
    @csrf
    <div>
        <label class="form-label" for="image-link"> Image Link </label>
        <textarea class="form-control" id="image-link" type="text" name="image-link">{{ old('image-link') }}</textarea>
        @error("image-link")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div>
        <label class="form-label" for="creator-name"> Creator Name </label>
        <input class="form-control" id="creator-name" type="text" name="creator-name" value="{{ old('creator-name') }}">
        @error("creator-name")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div>
        <label class="form-label" for="creator-link"> Creator Link </label>
        <input class="form-control" id="creator-link" type="text" name="creator-link" value="{{ old('creator-link') }}">
        @error("creator-link")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div>
        <label class="form-label" for="description"> Description </label>
        <textarea class="form-control" id="description" type="text" name="description">{{ old('description') }}</textarea>
        @error("description")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div>
        <label for="theme" class="form-label">Theme</label>
        <select name="theme" id="theme" class="form-select">
            <option value="">-- Select Theme --</option>

            @foreach ($themes as $theme)
                <option value="{{$theme->id}}" {{ (string) $theme->id === old('theme') ? "selected" : "" }}>
                    {{$theme->theme}}
                </option>
            @endforeach
        </select>
        @error("theme")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div>
        <label for="category" class="form-label">Category</label>
        <select name="category" id="category" class="form-select">
            <option value="">-- Select Category --</option>

            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ (string) $category->id === old('category') ? "selected" : "" }}>
                    {{$category->category}}
                </option>
            @endforeach
        </select>
        @error("category")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div>
        <label for="season" class="form-label">Season</label>
        <select name="season" id="season" class="form-select">
            <option value="">-- Select Season --</option>

            @foreach ($seasons as $season)
                <option value="{{$season->id}}" {{ (string) $season->id === old('season') ? "selected" : "" }}>
                    {{$season->season}}
                </option>
            @endforeach
        </select>
        @error("season")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <button type="submit" class="btn button"> Submit </button>
    <button type="reset" class="btn button"> Reset </button>
</form>

</div>

@endsection