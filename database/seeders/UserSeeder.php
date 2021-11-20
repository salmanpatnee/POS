<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
            
        $user->role_id = 1;
        $user->name = 'Salman';
        $user->email = 'salmanabdulghani.cis@gmail.com';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
