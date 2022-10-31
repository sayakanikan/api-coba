<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use App\Models\Laporan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'ali',
            'username' => 'ali123',
            'email' => 'ali@gmail.com',
            'password' => '123',
            'role_id' => '0'
        ]);
        
        User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'role_id' => '1'
        ]);

        Laporan::factory()->create([
            'user_id' => '1',
            'laporan' => 'Tembok bolong',
            'status' => '0',
            'foto' => 'https://res.cloudinary.com/dpvrgo0ll/image/upload/v1666618854/ryaiuyvh4ff9m7gsfehi.jpg'
        ]);
    }
}
