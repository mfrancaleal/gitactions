<?php


namespace App\GraphQL\Queries;


use App\Models\Job;

class JobQuery
{
    public function byStatus($root, array $args)
    {
        return Job::query()
        ->where('status', $args['status'])
        ->get();
    }
}
