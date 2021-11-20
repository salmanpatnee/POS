<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Administrator', 'Manager', 'Cashier'];

        foreach($roles as $roleName) {
            
            $role = new Role;
            
            $role->name = $roleName;
            $role->save();
        }
    }
}
