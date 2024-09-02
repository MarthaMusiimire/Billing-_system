<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionToCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionUnderCategory = [
            'user management' => [
                'create user',
                'edit user',
                'delete user',
                'view user',
                'assign roles',
                'revoke roles',
                'assign permissions'
            ],
            'system management' => [
                'manage system settings',
            ],
            'client management' => [
                'create client',
                'edit client',
                'delete client',
                'view client',
                
            ],
            'invoice management' => [
                'create invoice',
                'edit invoice',
                'delete invoice',
                'view invoice',
            ],
            'report management' => [
                'view reports',
                'generate reports',
            ],
        ];

        // Wrapping in a transaction ensures atomicity
        DB::transaction(function() use ($permissionUnderCategory) {

            // Create Permissions and associate them with Categories
            foreach ($permissionUnderCategory as $categoryName => $permissions) {

                // Check if the category exists and get the ID
                $categoryId = DB::table('permission_categories')->where('name', $categoryName)->value('id');

                // If category doesn't exist, skip creating permissions for it
                if ($categoryId) {
                    foreach ($permissions as $permission) {
                        Permission::firstOrCreate([
                            'name' => $permission,
                            'category_id' => $categoryId, // Ensure your permissions table has a category_id column
                        ]);
                    }
                } else {
                    // Optionally log or throw an error if the category does not exist
                    // Log::warning("Category {$categoryName} not found. Skipping permission creation.");
                }
            }
        });

        // Define roles and their associated permissions
        $roles = [
            'Admin' => [
                'create user',
                'edit user',
                'delete user',
                'view user',
                'assign roles',
                'revoke roles',
                'assign permissions',
                'manage system settings',
                'create client',
                'edit client',
                'delete client',
                'view client',
                'create invoice',
                'edit invoice',
                'delete invoice',
                'view invoice',
                'view reports',
                'generate reports',
            ],
            // Add more roles as necessary
        ];

        // Creating Roles and Assigning Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions); // syncPermissions will replace the role's existing permissions with the new ones
        }
    }
}

?>