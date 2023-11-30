<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Format;
use App\Models\Gender;
use App\Models\Publisher;
use App\Models\Subgender;
use App\Models\BookPurchaseDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Initial Seeders
        $this->call(UserSeeder::class);
        $this->call(AuthorSeeder::class);
        Publisher::factory(4)->create();
        $this->call(GenderSeeder::class);
        $this->call(SubgenderSeeder::class);
        $this->call(FormatSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(BookSeeder::class);
        BookPurchaseDetail::factory(25)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
