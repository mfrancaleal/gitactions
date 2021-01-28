<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(
            [
                [
                    'genre' => 'Romance',
                    'created_at' => now()
                ],
                [
                    'genre' => 'Policial',
                    'created_at' => now()
                ],
                [
                    'genre' => 'Notícia',
                    'created_at' => now()
                ],
                [
                    'genre' => 'Política',
                    'created_at' => now()
                ],
                [
                    'genre' => 'Suspense',
                    'created_at' => now()
                ],
                [
                    'genre' => 'Ficção',
                    'created_at' => now()
                ]
            ]
        );
    }
}
