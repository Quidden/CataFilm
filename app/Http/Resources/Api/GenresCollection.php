<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GenresCollection extends ResourceCollection
{
    public static $wrap = 'genres';

    public $collects = GenreResource::class;
}
