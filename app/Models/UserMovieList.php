<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserMovieList extends Model
{
    use HasFactory;

    public const STATUS_PLAN_TO_WATCH = 'plan_to_watch';
    public const STATUS_WATCHING = 'watching';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_DROPPED = 'dropped';

    public const STATUSES = [
        self::STATUS_PLAN_TO_WATCH,
        self::STATUS_WATCHING,
        self::STATUS_COMPLETED,
        self::STATUS_DROPPED,
    ];

    protected $fillable = [
        'user_id',
        'movie_id',
        'status',
        'rating',
        'rewatch_count',
        'watched_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'rewatch_count' => 'integer',
        'watched_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
