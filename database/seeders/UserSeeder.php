<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email' , 'seeder@user2.com')->first();
        if(!$user){
            $user = new User();
        }

        $user->first_name = 'User';
        $user->last_name = 'Seeder';
        $user->email = 'seeder@user2.com';
        $user->password = Hash::make('Test@123');
        $user->gender = 'Male';
        $user->save();

        

        // User::create([
        //     'first_name' => 'Hasanuzzaman',
        //     'last_name' => 'Priyam',
        //     'email' => 'priyam@example.com',
        //     'password' => Hash::make('password123'),
        //     'gender' => 'male',
        //     'mo_no' => '01700000000',
        // ]);

        // // User::factory()->count(10)->create();
    }
}
