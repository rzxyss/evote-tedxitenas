<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@tedxitenas.com',
            'password' => Hash::make('12345678')
        ]);

        if ($user) {
            $user->assignRole('superadmin');
        }
    }
}
