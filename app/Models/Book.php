<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'stock', 'author_id', 'published_year', 'description'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
