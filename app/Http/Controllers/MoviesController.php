<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = new MovieCollection(Movie::latest()->get());
        return response()->json($movies);
    }

    public function store(Request $request)
    {
        $validation = $this->validation($request->all());
        if ($validation->fails()) return response()->json([
            'status' => false,
            'errors' => $validation->errors()
        ], 422);

        $request['track_id'] = random_int(10000000, 99999999);
        $request['slug'] = Str::slug($request->title);
        $data = Movie::create($this->fields($request->all()));

        return response()->json([
            'status' => true,
            'message' => 'Movie has been added.',
            'data' => $data
        ]);
    }

    public function show(Movie $movie)
    {
        return response()->json([
            new MovieResource($movie)
        ]);
    }

    public function update(Request $request, Movie $movie)
    {
        $validation = $this->validation($request->all());
        if ($validation->fails()) return response()->json([
            'status' => false,
            'errors' => $validation->errors()
        ], 422);

        $request['track_id'] = $movie->track_id;
        $request['slug'] = $movie->slug;
        $movie->update($this->fields($request->all()));

        return response()->json([
            'status' => true,
            'message' => 'Movie has been updated.',
            'data' => $movie
        ]);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json([
            'status' => true,
            'message' => 'Movie has been deleted.'
        ]);
    }

    private function fields(array $attributes): array
    {
        return [
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'track_id' => $attributes['track_id'],
            'description' => $attributes['description'],
            'age_restricted' => $attributes['age_restricted'],
            'release_year' => $attributes['release_year'],
            'season' => $attributes['season'],
            'genre' => $attributes['genre'],
            'thumbnail' => $attributes['thumbnail'],
            'starring' => $attributes['starring'],
            'director' => $attributes['director'],
        ];
    }

    private function validation(array $attributes): \Illuminate\Validation\Validator
    {
        return \Validator::make($attributes, [
            'title' => ['required'],
            'description' => ['required'],
            'age_restricted' => ['required'],
            'release_year' => ['required', 'numeric'],
            'season' => ['required'],
            'genre' => ['required'],
            'thumbnail' => ['required'],
            'starring' => ['required'],
            'director' => ['required'],
        ]);
    }
}
