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
     *  
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name'     => 'Admin',
                'employee_number'   => 'AXT1001',
                'email'    => 'admin@admin.com',
                'mobile'   => '123456789',
                'role_id'  => 1,
                'password' => Hash::make('12345678'),
            ]
           
        ];
        foreach ($admins as $admin) {
            $user = User::where('email', $admin['email'])->first();
            if (!$user) {
                User::create([
                    'name'      => $admin['name'],
                    'employee_number' => $admin['employee_number'],
                    'email'     => $admin['email'],
                    'mobile'    => $admin['mobile'],
                    'password'  => $admin['password'],
                    'role_id'  => $admin['role_id']

                ]);
            }
        }
    }
}
