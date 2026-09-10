<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\Attributes\Sluggable;

#[Sluggable(from: 'title', to: 'slug', onUpdate: false)]
class Tag extends Model
{
    protected $fillable = ['title'];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
