<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'content',
        'contains_spoilers',
    ];

    protected $casts = [
        'contains_spoilers' => 'boolean',
    ];

    /**
     * sscope reviews to newest first. matching the 'movie_id, created_at' index.
     */
    public function scopeOrderByLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
