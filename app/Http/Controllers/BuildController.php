<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Build;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Season;
use App\Models\Comment;
use App\Models\Favorite;
use Auth;

class BuildController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Invoice::class);

        $builds = Build::with([
                    'category', 'theme', 'season'
                    ])
                ->orderBy('created_at', 'desc')
                ->take(9)
                ->get();

        $comments = Comment::with(['build', 'user'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('build.index', [
            'builds' => $builds,
            'comments' => $comments,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        $themes = Theme::all();
        $categories = Category::all();
        $seasons = Season::all();

        return view('build.create', [
            'themes' => $themes,
            'categories' => $categories,
            'seasons' => $seasons,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image-link' => 'required|url|unique:builds,img_link',
            'creator-name' => 'required',
            'creator-link' => 'required|url',
            'description' => 'required|min:5|max:500',
            'theme' => 'required|exists:themes,id',
            'category' => 'required|exists:categories,id',
            'season' => 'required|exists:seasons,id',
        ]);

        $build = new Build();
        $build->img_link = $request->input('image-link');
        $build->creator_name = $request->input('creator-name');
        $build->creator_link = $request->input('creator-link');
        $build->description = $request->input('description');
        $build->creator_name = $request->input('creator-name');
        $build->theme()->associate(Theme::find($request->input('theme')));
        $build->category()->associate(Category::find($request->input('category')));
        $build->season()->associate(Season::find($request->input('season')));
        $build->user_id = Auth::user()->id;

        $build->save();

        return redirect()
            ->route('build.index')
            ->with('success', "The build has been added!");
    }

    public function edit($id)
    {
        $build = Build::with([
            'category', 'theme', 'season',
            ])
            ->find($id);

        $themes = Theme::all();
        $categories = Category::all();
        $seasons = Season::all();

        $this->authorize('update', $build);

        return view ('build.edit', [
            'build' => $build,
            'themes' => $themes,
            'categories' => $categories,
            'seasons' => $seasons,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'image-link' => 'required|url',
            'creator-name' => 'required',
            'creator-link' => 'required|url',
            'description' => 'required|min:5|max:500',
            'theme' => 'required|exists:themes,id',
            'category' => 'required|exists:categories,id',
            'season' => 'required|exists:seasons,id',
        ]);

        $build = Build::find($id);
        
        $build->img_link = $request->input('image-link');
        $build->creator_name = $request->input('creator-name');
        $build->creator_link = $request->input('creator-link');
        $build->description = $request->input('description');
        $build->creator_name = $request->input('creator-name');
        $build->theme()->associate(Theme::find($request->input('theme')));
        $build->category()->associate(Category::find($request->input('category')));
        $build->season()->associate(Season::find($request->input('season')));

        $build->save();

        $this->authorize('update', $build);

        return redirect()
            ->route('build.index')
            ->with('success', "Successfully updated the build!");
    }

    public function search()
    {
        $themes = Theme::all();
        $categories = Category::all();
        $seasons = Season::all();

        return view('build.search', [
            'themes' => $themes,
            'categories' => $categories,
            'seasons' => $seasons,
        ]);
    }

    public function result(Request $request)
    {
        $request->validate([
            'theme' => 'nullable|exists:themes,id',
            'category' => 'nullable|exists:categories,id',
            'season' => 'nullable|exists:seasons,id',
        ]);

        $builds = Build::with([
            'category', 'theme', 'season'
            ])
        ->orderBy('id', 'desc');

        if($request->input('category')) {
            $builds->where('category_id', '=', $request->input('category'));
        }

        if($request->input('theme')) {
            $builds->where('theme_id', '=',  $request->input('theme'));
        }

        if($request->input('season')) {
            $builds->where('season_id', '=',  $request->input('season'));
        }

        $builds = $builds->get();

        $comments = Comment::with(['build', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('build.result', [
            'builds' => $builds,
            'comments' => $comments,
        ]);
    }

    public function delete($id)
    {
        $build = Build::find($id);

        $build->delete();

        return redirect()
        ->route('profile.index')
        ->with('success', "Build successfully deleted.");
    }
}
