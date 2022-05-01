@extends("layouts.main")

@section("title", "Search")

@section("content")

<div id="heading">
    <h4>
        Search
    </h4>
</div>

<form action="{{ route('build.result') }}" method="GET" id="narrow-form">
    
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
        {{-- <!-- @error("theme")
            <small class="text-danger">{{$message}}</small>
        @enderror --> --}}
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
        {{-- <!-- @error("category")
            <small class="text-danger">{{$message}}</small>
        @enderror --> --}}
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
        {{-- <!-- @error("season")
            <small class="text-danger">{{$message}}</small>
        @enderror --> --}}
    </div>

    <button type="submit" class="btn button"> Submit </button>
    <button type="reset" class="btn button"> Reset </button>
</form>

@endsection