<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        // Dashboard & General
        Permission::firstOrCreate(['name' => 'view dashboard']);

        // Blog Management
        Permission::firstOrCreate(['name' => 'manage blog posts']);

        // User & Role Management (restricted to higher roles)
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'manage roles']);
        Permission::firstOrCreate(['name' => 'manage permissions']);

        // Student Management
        Permission::firstOrCreate(['name' => 'view students']);
        Permission::firstOrCreate(['name' => 'create students']);
        Permission::firstOrCreate(['name' => 'edit students']);
        Permission::firstOrCreate(['name' => 'delete students']);

        // Teacher Management
        Permission::firstOrCreate(['name' => 'view teachers']);
        Permission::firstOrCreate(['name' => 'create teachers']);
        Permission::firstOrCreate(['name' => 'edit teachers']);
        Permission::firstOrCreate(['name' => 'delete teachers']);

        // Result & Academic Management (example for future broadsheet)
        Permission::firstOrCreate(['name' => 'manage results']);
        Permission::firstOrCreate(['name' => 'view results']);
        Permission::firstOrCreate(['name' => 'enter scores']);

        // School Settings
        Permission::firstOrCreate(['name' => 'manage settings']);

        // Create Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $student = Role::firstOrCreate(['name' => 'student']);

        // Assign Permissions to Roles

        // Super Admin - has ALL permissions
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - almost everything except managing roles/permissions/users
        $admin->givePermissionTo([
            'view dashboard',
            'manage blog posts',
            'view students',
            'create students',
            'edit students',
            'delete students',
            'view teachers',
            'create teachers',
            'edit teachers',
            'delete teachers',
            'manage results',
            'enter scores',
            'manage settings',
        ]);

        // Teacher - limited access
        $teacher->givePermissionTo([
            'view dashboard',
            'view students',
            'view results',
            'enter scores',
            'manage blog posts', // optional: teachers can write posts
        ]);

        // Student - very limited
        $student->givePermissionTo([
            'view dashboard',
            'view results', // can only see their own results later via policy
        ]);

        // Create Sample Super Admin User
        $superAdminUser = User::firstOrCreate(
            ['email' => 'gospelin.gi@gmail.com'],
            [
                'name' => 'GIGOTECH GLOBAL NETWORKS',
                'password' => Hash::make('Tripled@121'), // Change this in production!
            ]
        );
        $superAdminUser->assignRole('super-admin');

        // Optional: Create sample users for other roles
        // Uncomment if you want them seeded too

      
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@divinelight.edu.ng'],
            [
                'name' => 'School Admin',
                'password' => Hash::make('Tripled@121'), // Change this in production!
            ]
        );
        $adminUser->assignRole('admin');
        /*
      $teacherUser = User::firstOrCreate(
          ['email' => 'teacher@divinelight.edu.ng'],
          [
              'name' => 'John Teacher',
              'password' => Hash::make('teacher123'),
          ]
      );
      $teacherUser->assignRole('teacher');

      $studentUser = User::firstOrCreate(
          ['email' => 'student@divinelight.edu.ng'],
          [
              'name' => 'Jane Student',
              'password' => Hash::make('student123'),
          ]
      );
      $studentUser->assignRole('student');
      */
    }
}