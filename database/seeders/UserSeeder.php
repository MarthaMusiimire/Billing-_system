<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            'name' => 'Musiimire Martha',
            'email' => 'musiimiremartha@gmail.com',
            'password' => bcrypt('1234567890'),
            'role' => 'admin',

        ];
        foreach ($users as $userData){
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'=>$userData['name'],
                    'password'=>$userData['password'],
                
                ]
              
            );

            $role = Role::firstOrCreate(['name' => $userData ['admin']]);
            $user->assignRole($role);
        }
        
    }
}
