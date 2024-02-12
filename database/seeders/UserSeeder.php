<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'landlord.admin@travware.com';

        $existingUser = User::where('email' , $email)->first();

        if (! $existingUser){
            User::factory()->create([
                'email' => $email,
            ]);
        }
    }
}
