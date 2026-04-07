<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes; // use traits مرة واحدة بس

    protected $fillable = ['title', 'desc', 'image', 'user_id'];

    // Polymorphic relation: post has many comments
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}