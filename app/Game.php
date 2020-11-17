<?php

namespace App;

use App\Genre;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = ['name', 'release_at'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
