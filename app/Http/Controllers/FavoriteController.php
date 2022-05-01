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
    public function store(Request $request, $id)
    {
    }

    public function index()
    {
        $user = Auth::user();

        $favorites = Favorite::with([
                'build',
                'build.theme',
                'build.category',
                'build.season',
                'user',
                ])
                ->where('user_id', '=', $user->id)
                ->get();

        $comments = Comment::with(['build', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

        $isCreators = Build::with([
            'theme',
            'category',
            'season',
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
}
