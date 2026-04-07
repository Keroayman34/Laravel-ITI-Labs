<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Allow mass assignment for body
    protected $fillable = ['body'];

    // Polymorphic relation: comment belongs to any model (Post, etc.)
    public function commentable()
    {
        return $this->morphTo();
    }
}