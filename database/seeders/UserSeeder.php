<?php
namespace Database\Seeders;

use App\Models\User;
// use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role_id' => 1,
        // ]);

        // $admin->assignRole('admin');

        $low_user = User::create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 3,
        ]);

        $low_user->assignRole('low_user');
    }
}
