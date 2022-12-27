<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appEnv = env('APP_ENV');
        if ($appEnv === 'local') {
            //dev master account
            User::create([
                'name' => 'Hulyo Firmansyah',
                'email' => 'axusxzbitcomp@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
                'role' => 'dev'
            ]);
            User::factory(10)->create();
        } else {
            // Dev
            User::create([
                'name' => 'Hulyo Firman Syahputra',
                'email' => 'axusxzbitcomp@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$DON3mv2eXNCk4SGZBVcA6ue6v/AhsoNrVdA/0uKOWSJgCA6HTT1Uq',
                'remember_token' => Str::random(10),
                'role' => 'dev'
            ]);
            //Owner
            User::create([
                'name' => 'RPK Owner',
                'email' => 'masterrpk09@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$UCyPmB6wDqvcVN7oRBV.xuvy5u9I8N1UDs/P4CD4puLIxto3dt4pu',
                'remember_token' => Str::random(10),
                'role' => 'owner'
            ]);
        }
    }
}
