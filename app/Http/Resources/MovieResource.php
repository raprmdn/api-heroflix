<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MovieResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'track_id' => $this->track_id,
            'description' => $this->description,
            'age_restricted' => $this->age_restricted,
            'release_year' => $this->release_year,
            'season' => $this->season,
            'genre' => $this->genre,
            'thumbnail' => $this->thumbnail,
            'starring' => $this->starring,
            'director' => $this->director,
            'created_at' => $this->created_at->format('d F Y H:i:s'),
        ];
    }
}
