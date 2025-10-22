<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'seeder@admin.com')->first();
        if (!$user) {
            $user = new User();
        }
        $user->first_name = 'Admin';
        $user->last_name = 'Seeder';
        $user->email = 'seeder@admin.com';
        $user->password = Hash::make('Test@123');
        $user->gender = 'Male';
        $user->save();
    }
}
