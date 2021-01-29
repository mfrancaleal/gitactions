<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public  function byStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public  function scopeOfUserType($query, array $args)
    {
        $status = $args['status'] ?? null;

        return $query->when(! is_null($status), function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
}
