<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            User::factory(100)
                 ->has(
                     Todo::factory()
                         ->count(value(fn () => random_int(5, 10)))
                         ->has(TodoItem::factory()->count(value(fn () => random_int(5, 15))), 'items')
                 )
                 ->create();
        });
    }
}
