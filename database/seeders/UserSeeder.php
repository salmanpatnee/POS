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
        $admin = new User();
        $admin->role_id = 1;
        $admin->name = 'Salman';
        $admin->email = 'salmanabdulghani.cis@gmail.com';
        $admin->password = '12345678';
        $admin->save();

        $manager = new User();
        $manager->role_id = 2;
        $manager->name = 'Adnan';
        $manager->email = 'muhammadadnan.cis@gmail.com';
        $manager->password = '12345678';
        $manager->save();

        $cashier = new User();
        $cashier->role_id = 3;
        $cashier->name = 'Asim';
        $cashier->email = 'asimatiq.cis@gmail.com';
        $cashier->password = '12345678';
        $cashier->save();
    }
}
