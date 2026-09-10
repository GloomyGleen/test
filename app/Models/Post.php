<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\Attributes\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

#[Sluggable(from: 'title', to: 'slug')]
class Post extends Model
{

    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail'];

    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public static function uploadImg(Request $request, $img = null) {
        if ($request->hasFile('thumbnail')) {
            if ($img) Storage::delete($img);
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }

    public function getImg() {
        if (!$this->thumbnail) {
            return asset('uploads/images/no-img.png');
        }
        return asset("uploads/{$this->thumbnail}");
    }

    public function getPostDate() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F, Y');
    }

    public function scopeLike($query, $string) {
        return $query->where('title', 'LIKE', "%{$string}%");
    }

}
