<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Run Location and Master Data Seeders
        $this->call([
            LocationSeeder::class ,
            MasterDataSeeder::class ,
        ]);

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $hrRole = Role::firstOrCreate(['name' => 'HR']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);

        // Create Super Admin User
        $superAdmin = User::firstOrCreate(
        ['email' => 'superadmin@hrms.com'],
        [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Create Admin User
        $admin = User::firstOrCreate(
        ['email' => 'admin@hrms.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
        );
        $admin->assignRole($adminRole);

        // Optional: Create basic users for testing
        $hrUser = User::firstOrCreate(
        ['email' => 'hr@hrms.com'],
        [
            'name' => 'HR User',
            'password' => Hash::make('password'),
        ]
        );
        $hrUser->assignRole($hrRole);

        $managerUser = User::firstOrCreate(
        ['email' => 'manager@hrms.com'],
        [
            'name' => 'Manager User',
            'password' => Hash::make('password'),
        ]
        );
        $managerUser->assignRole($managerRole);
    }
}
