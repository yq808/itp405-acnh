<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Build;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Season;

use App\Models\Comment;

use App\Models\Favorite;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $isCreators = Build::with([
                'theme',
                'category',
                'season',
                ])
                ->where('user_id', '=', $user->id)
                ->orderBy('updated_at', 'desc')
                ->get();

        $comments = Comment::with(['build', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

        $favorites = Favorite::with([
            'build',
            'build.theme',
            'build.category',
            'build.season',
            'user',
            ])
            ->where('user_id', '=', $user->id)
            ->get();

        $favorites = count($favorites);
        
        return view('profile.index', [
            'isCreators' => $isCreators,
            'comments' => $comments,
            'user' => Auth::user(),
            'favorites' => $favorites,
        ]);
    }
}
