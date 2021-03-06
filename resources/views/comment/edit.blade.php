@extends("layouts.main")

@section("title")
    Edit Comment
@endsection

@section("content")
<div id="heading">
    <h4>
        Edit comment for {{ $comment->build->creator_name }}'s Build
    </h4>
</div>

<form action="{{ route('comment.update', ['id' => $comment->id]) }}" method="POST" id="edit-form">
    @csrf
    <div>
        <textarea class="form-control" id="comment" type="text" name="comment">{{ old('comment', $comment->comment) }}</textarea>
        @error("comment")
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <button type="submit" class="btn button">Edit Comment</button>
</form>
@endsection