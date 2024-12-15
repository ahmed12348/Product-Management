<?php

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
    'role-list',
    'role-create',
    'role-edit',
    'role-delete',
    'edit_users',
    'view_users',
    'create_users',
    'delete_users',
    'import_awbs',
    'create_awbs',
    'export_awbs',
    'edit_awbs',
    'view_awbs',
    'delete_awbs',
    'edit_driver',
    'view_driver',
    'create_driver',
    'delete_driver',
    'dashboard_1',
    'dashboard_2',
    'dashboard_3',
    ];



    public function run()
    {
        // Create permissions
        foreach ($this->permissions as $permission) {
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles and assign permissions
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Assign all permissions to superadmin
        $superadminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to admin
        $adminRole->givePermissionTo([
        
            'edit_users',
            'view_users',
            'export_awbs',
            'edit_awbs',
            'view_awbs',
            'edit_driver',
            'view_driver',
        ]);

        // Assign limited permissions to user
        $userRole->givePermissionTo([
            'view_users',
            'view_awbs',
            'view_driver',
        ]);

        // Create admin user and assign the superadmin role
        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
            ]
        );

        $user->assignRole([$superadminRole->id]);

        // Optionally, create additional users with different roles
        // Example:
        /*
        $user2 = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'hub_name' => 'user_hub', // Ensure this field is in your users table
            ]
        );

        $user2->assignRole([$userRole->id]);
        */
    }
}
