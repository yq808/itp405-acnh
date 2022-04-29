<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Build;
use App\Models\Category;
use App\Models\Theme;
use App\Models\Season;

class BuildController extends Controller
{
    public function index()
    {
        $builds = Build::with([
                    'category', 'theme', 'season',
                    ])
                ->orderBy('id', 'desc')
                ->take(15)
                ->get();
        
        return view('build.index', [
            'builds' => $builds,
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

    public function store()
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
            'image-link' => 'required|url|unique:builds,img_link',
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

        return redirect()
            ->route('build.index')
            ->with('success', "Successfully updated the build!");
    }
}
