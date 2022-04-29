@extends("layouts.main")

@section("title")
    Edit Build by {{$build->creator_name}}
@endsection

@section("content")

<form action="{{ route('build.update') }}" method="POST">
    <div>
        <label class="form-label" for="image-link"> Image Link </label>
        <input class="form-control" id="image-link" type="text" name="image link" value="{{ old('image-link', $build->img_link) }}" placeholder="">
    </div>
    <div>
        <label class="form-label" for="creator-name"> Creator Name </label>
        <input class="form-control" id="creator-name" type="text" name="creator name" value="{{ old('creator-name', $build->creator_name)}}" placeholder="">
        {{-- <!-- @error("title")
            <small class="text-danger">{{$message}}</small>
        @enderror --> --}}
    </div>
    <div>
        <label class="form-label" for="creator-link"> Creator Link </label>
        <input class="form-control" id="creator-link" type="text" name="creator link" value="{{ old('creator-link', $build->creator_link)}}" placeholder="">
    </div>
    <div>
        <label class="form-label" for="desription"> Description </label>
        <textarea class="form-control" id="desription" type="text" name="description" value="{{ old('description', $build->description)}}" placeholder=""></textarea>
    </div>

    <div>
        <label for="theme" class="form-label">Theme</label>
        <select name="theme" id="theme" class="form-select">
            <option value="">-- Select Theme --</option>

            @foreach ($themes as $theme)
                <option value="{{$theme->id}}" {{ (string) $theme->id === (string) old('theme', $build->theme_id) ? "selected" : "" }}>
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
                <option value="{{$category->id}}" {{ (string) $category->id === (string) old('theme', $build->theme_id) ? "selected" : "" }}>
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
                <option value="{{$season->id}}" {{ (string) $season->id === (string) old('theme', $build->theme_id) ? "selected" : "" }}>
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