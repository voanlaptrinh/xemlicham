<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
       
        Category::create([
            'title' => 'Lịch tháng',
            'metaTitle' => 'Lịch tháng',
            'metaDescription' => 'Lịch tháng',
        ]);
        Category::create([
            'title' => 'Lịch năm',
            'metaTitle' => 'Lịch năm',
            'metaDescription' => 'Lịch năm',
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2a$12$Z7Lvk1HUjKKpx5i9hslHWuFmEKNX0PtNL9Fuz2AY0gGk.iVh7/Lza',
            'role' => 'admin'

        ]);
    }
}
