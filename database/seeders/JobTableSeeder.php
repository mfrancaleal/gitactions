<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();
        Job::unguard();

        $faker = Factory::create();

        User::all()->each(function ($user) use ($faker){
            foreach (range(1,5) as $i){

                $status = 'QUEUED';

                if($i == 4) {
                    $status =   'PROCESSING';
                } elseif ($i == 5) {
                    $status = 'COMPLETE';
                }

                Job::create([
                    'user_id' => $user->getKey(),
                    'title' => $faker->sentence,
                    'status' => $status
                ]);
            }
        });
    }
}
