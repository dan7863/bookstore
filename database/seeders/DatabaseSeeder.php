<?php

namespace Database\Seeders;

use App\Models\Publisher;
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
        $this->call(LanguageSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(BookPurchaseDetailSeeder::class);
        $this->call(OrderLineSeeder::class);
        $this->call(CommentSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
