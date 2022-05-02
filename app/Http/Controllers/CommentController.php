<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use App\Models\Build;
// use App\Models\Category;
// use App\Models\Theme;
// use App\Models\Season;
use App\Models\Comment;
// use App\Models\Favorite;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:5|max:500',
        ]);

        $comment = new Comment();
        $comment->build_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->input('comment');

        $comment->save();

        return redirect()
            ->route('build.index')
            ->with('success', "Your comment was posted.");
    }

    public function edit($id)
    {
        $comment = Comment::with(['build', 'user'])
                ->find($id);

        return view ('comment.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->cannot('update', Comment::class)) {
            abort(403);
        }

        $request->validate([
            'comment' => 'required|min:5|max:500',
        ]);

        $comment = Comment::find($id);

        $comment->comment = $request->input('comment');

        $comment->save();

        return redirect()
            ->route('build.index')
            ->with('success', "Your comment has been edited.");
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        // if (Auth::user()->cannot('delete', $comment)) {
        //     abort(403);
        // }

        $comment->delete();

        return redirect()
        ->route('build.index')
        ->with('success', "Comment successfully deleted");
    }
}
