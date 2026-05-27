<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@tedxitenas.com',
            'password' => Hash::make('12345678')
        ]);

        if ($superadmin) {
            $superadmin->assignRole('superadmin');
        }

        $committee = User::create([
            'name' => 'Committee',
            'email' => 'committee@tedxitenas.com',
            'password' => Hash::make('12345678')
        ]);

        if ($committee) {
            $committee->assignRole('committee');
        }

        $voter = User::create([
            'name' => 'Voter',
            'email' => 'voter@tedxitenas.com',
            'password' => Hash::make('12345678')
        ]);

        if ($voter) {
            $voter->assignRole('voter');
        }

        $nizar = User::create([
            'name' => 'Nizar Abdul Malik',
            'email' => 'nizar.abdul@mhs.itenas.ac.id',
            'password' => Hash::make('12345678')
        ]);

        if ($nizar) {
            $nizar->assignRole('voter');
        }
    }
}
