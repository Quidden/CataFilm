<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const REGEX_USERNAME = '/^[\pL\pM\pN._-]+$/u';

    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movieLists()
    {
        return $this->hasMany(UserMovieList::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function customCollections()
    {
        return $this->hasMany(CustomCollection::class);
    }
}
