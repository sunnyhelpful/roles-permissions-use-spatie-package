<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $modules = ['users'];  /* From Here We can assign the module */

        foreach ($modules as $module) {
            $this->defineModulePermissions($module);
        }

        $admin_role = Role::create(['name' => 'admin']);

        /* $admin_role->syncPermissions([
            'can-view',
            'can-create', 
            'can-edit',
            'can-delete'
        ]); */

        $adminPermissions = [];
        foreach ($modules as $module) {
            $adminPermissions[] = "can-view-$module";
            $adminPermissions[] = "can-create-$module";
            $adminPermissions[] = "can-edit-$module";
            $adminPermissions[] = "can-delete-$module";
        }
        $admin_role->syncPermissions($adminPermissions);

        Role::create(['name' => 'user']);

        //admin user
        $admin = User::create([
            'name'                    => 'Admin',
            'email'                   => 'admin@gmail.com',
            'email_verified_at'       => now(),
            'created_at'              => now(),
            'updated_at'              => now(),
            'password'                => Hash::make('Admin@1234') // <---- Remember this

        ]);
        $admin->assignRole('admin');
        
        $admin->syncPermissions($admin->getPermissionsViaRoles());

        //users
        $guest_role=User::create([
            'name'                    => 'User Guest',
            'email'                   => 'guestuser@gmail.com',
            'email_verified_at'       => now(),
            'created_at'              => now(),
            'updated_at'              => now(),
            'password'                => Hash::make('User@1234') // <---- Remember this
        ]);

        $guest_role->assignRole('user');

        $guest_role=User::create([
            'name'                    => 'User Guest',
            'email'                   => 'guestuser1@gmail.com',
            'email_verified_at'       => now(),
            'created_at'              => now(),
            'updated_at'              => now(),
            'password'                => Hash::make('User@1234') // <---- Remember this
        ]);

        $guest_role->assignRole('user');
        
    }

    protected function defineModulePermissions($moduleName)
    {
        Permission::create(['name' => "can-view-$moduleName"]);
        Permission::create(['name' => "can-create-$moduleName"]);
        Permission::create(['name' => "can-edit-$moduleName"]);
        Permission::create(['name' => "can-delete-$moduleName"]);
    }
}
