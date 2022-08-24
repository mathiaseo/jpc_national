<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'video_link',
        'image_gallery_id',
        'published_at',
        'type',
        'views',
        'like',
        'favorite',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image_gallery_id' => 'integer',
        'published_at' => 'timestamp',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function imageGallery()
    {
        return $this->hasOne(ImageGallery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageGallery()
    {
        return $this->belongsTo(ImageGallery::class);
    }
}
