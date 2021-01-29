<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'author_id',
        'genre_id',
        'title',
        'year'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genres(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
