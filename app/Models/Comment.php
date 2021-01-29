<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'author_id',
        'post_id',
        'commentary'
    ];

    public function authors(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }


}
