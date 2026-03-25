<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class TempRoleSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $roles = [
            'Super Admin',
            'Admin',
            'Employee',
            'Manager',
            'HR',
            'ERO',
            'Shift Planner',
            'PAYROLL USER',
            'Data Entry',
            'Data Entry Non Academic'
        ];
        
        foreach($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
