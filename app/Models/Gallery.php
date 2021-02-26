<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function addGalleryImages($url, $id)
    {
        return $this->images()->create([
            'url' => $url,
            'gallery_id' => $id
        ]);
    }
    public function updateGalleryImages($url, $id)
    {
        return $this->images()->update([
            'url' => $url,
            'gallery_id' => $id
        ]);
    }
}
