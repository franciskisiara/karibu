<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(['adam', 'bob', 'cathy', 'dorris', 'eve', 'frank'])
            ->each(function ($name) {
                User::firstOrCreate([
                    'email' => "{$name}@appaweek.test",
                ], [
                    'name' => ucwords($name),
                    'email_verified_at' => now(),
                    'password' => 'Pass@w0rd1',
                ]);
            });
    }
}
