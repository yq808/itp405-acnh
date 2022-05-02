<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Build;
use App\Models\Favorite;
use App\Models\User;

use App\Models\Category;
use App\Models\Theme;
use App\Models\Season;

use App\Models\Comment;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $favorites = Favorite::with([
                'build',
                'build.theme',
                'build.category',
                'build.season',
                'user'
                ])
                ->where('user_id', '=', $user->id)
                ->orderBy('updated_at', 'desc')
                ->get();

        $comments = Comment::with(['build', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

        $isCreators = Build::with([
            'theme',
            'category',
            'season',
            'user'
            ])
            ->where('user_id', '=', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        $isCreators = count($isCreators);

        return view('favorite.index', [
            'favorites' => $favorites,
            'comments' => $comments,
            'user' => Auth::user(),
            'isCreators' => $isCreators,
        ]);
    }

    public function store($id)
    {
        // $request->validate([
        //     'id' => 'required|exists:builds,id',
        // ]);

        // if (count(Build::find($id)) == 0) {
        //     return redirect()
        //     ->route('favorite.index')
        //     ->with('error', "The build does not exist.");
        // }

        $exists = Favorite::where([
                ['user_id', '=', Auth::user()->id],
                ['build_id', '=', $id],
                ])
                ->get();
        
        if (count($exists) != 0) {
            return redirect()
                ->route('favorite.index')
                ->with('error', "This build is already in your favorites!");
        }

        $favorite = new Favorite();
        $favorite->user_id = Auth::user()->id;
        $favorite->build_id = $id;

        $favorite->save();

        return redirect()
            ->route('favorite.index')
            ->with('success', "The build has been added to your favorites!");
    }

    public function delete($id)
    {
        $favorite = Favorite::find($id);

        $favorite->delete();

        return redirect()
        ->route('favorite.index')
        ->with('success', "The build has been removed from your favorites.");
    }
}
