<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes; // use traits   

    protected $fillable = ['title', 'desc', 'image', 'user_id'];

    // Polymorphic relation: post has many comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800';
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (!Storage::disk('public')->exists($this->image)) {
            return 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800';
        }

        return asset('storage/' . $this->image);
    }
}