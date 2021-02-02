<?php

namespace App\GraphQL\Queries;

use App\Models\Job;
use Illuminate\Support\Collection;

class JobQuery
{
    public function byStatus(array $args): Collection
    {
        return Job::query()
            ->where('status', $args['status'])
            ->get();
    }
}
