<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*Seeder to create some records*/
            \App\Models\Dietary::factory(40)->create();
            \App\Models\Company::factory(40)->create();
            \App\Models\Employee::factory()->count(25)->create();
    }
}
