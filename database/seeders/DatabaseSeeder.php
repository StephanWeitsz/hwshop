<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Addresstype;
use App\Models\Contacttype;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //$this->clearDB();
        $this->seed_roles();
        $this->seed_permission();
        $this->seed_addresstypes();
        $this->seed_contacttypes();

        $this->seed_myuser();
        $this->seed_users();

    }

    public function clearDB() {
        DB::table('address_user')->truncate();
        DB::table('addresses')->truncate();
        DB::table('addresstypes')->truncate();

        DB::table('contact_user')->truncate();
        DB::table('contacts')->truncate();
        DB::table('contacttypes')->truncate();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_user')->truncate();
        DB::table('roles')->truncate();

        DB::table('posts')->truncate();
        DB::table('users')->truncate();
    }

    public function seed_roles() {
        Role::create(['name'=>'Admin', 'slug'=>'admin']);
        Role::create(['name'=>'Manager', 'slug'=>'manager']);
        Role::create(['name'=>'Subscriber', 'slug'=>'subscriber']);
    }

    public function seed_permission() {
        Permission::create(['name'=>'View Dashboard', 'slug'=>'view_dashboard']);
        Permission::create(['name'=>'View Admin Users', 'slug'=>'view_admin_users']);
        Permission::create(['name'=>'View Admin Posts', 'slug'=>'view_admin_posts']);
        Permission::create(['name'=>'View Admin Products', 'slug'=>'view_admin_products']);
        Permission::create(['name'=>'View Admin Orders', 'slug'=>'view_admin_orders_users']);
        Permission::create(['name'=>'View Admin Security', 'slug'=>'view_admin_security']);
        Permission::create(['name'=>'View Admin Utilities', 'slug'=>'view_admin_utilities']);
        Permission::create(['name'=>'View Admin Utilities Address Types', 'slug'=>'view_admin_utilities_addresstype']);
        Permission::create(['name'=>'View Admin Utilities Contact Types', 'slug'=>'view_admin_utilities_contacttype']);

        Permission::create(['name'=>'Create Users', 'slug'=>'create_users']);
        Permission::create(['name'=>'Show my Users', 'slug'=>'show_my_user']);
        Permission::create(['name'=>'Update my User', 'slug'=>'update_my_user']);
        Permission::create(['name'=>'Delete my User', 'slug'=>'delete_my_user']);
        Permission::create(['name'=>'Show any User', 'slug'=>'show_any_user']);
        Permission::create(['name'=>'Update any User', 'slug'=>'update_any_user']);
        Permission::create(['name'=>'Delete any User', 'slug'=>'delete_any_user']);

        Permission::create(['name'=>'View User Address', 'slug'=>'view_user_address']);
        Permission::create(['name'=>'Show User Address', 'slug'=>'show_user_address']);
        Permission::create(['name'=>'Update User Address', 'slug'=>'update_user_address']);
        Permission::create(['name'=>'Delete User Address', 'slug'=>'delete_user_address']);

        Permission::create(['name'=>'View User Contact', 'slug'=>'view_user_contact']);
        Permission::create(['name'=>'Show User Contact', 'slug'=>'show_user_contact']);
        Permission::create(['name'=>'Update User Contact', 'slug'=>'update_user_contact']);
        Permission::create(['name'=>'Delete User Contact', 'slug'=>'delete_user_contact']);

        Permission::create(['name'=>'Create Posts', 'slug'=>'create_posts']);
        Permission::create(['name'=>'Show my Post', 'slug'=>'show_my_post']);
        Permission::create(['name'=>'Update my Post', 'slug'=>'update_my_post']);
        Permission::create(['name'=>'Delete my Post', 'slug'=>'delete_my_post']);
        Permission::create(['name'=>'Show any Post', 'slug'=>'show_any_post']);
        Permission::create(['name'=>'Update any Post', 'slug'=>'update_any_post']);
        Permission::create(['name'=>'Delete any Post', 'slug'=>'delete_any_post']);

        Permission::create(['name'=>'Create Products', 'slug'=>'create_products']);
        Permission::create(['name'=>'Show Products', 'slug'=>'show_products']);
        Permission::create(['name'=>'Update Products', 'slug'=>'update_products']);
        Permission::create(['name'=>'Delete Products', 'slug'=>'delete_products']);

        Permission::create(['name'=>'Create Orders', 'slug'=>'create_orders']);
        Permission::create(['name'=>'Show Orders', 'slug'=>'show_orders']);
        Permission::create(['name'=>'Update Order', 'slug'=>'update_order']);
        Permission::create(['name'=>'cancel Order', 'slug'=>'cancel_order']);

        Permission::create(['name'=>'Create Role', 'slug'=>'create_role']);
        Permission::create(['name'=>'Show Roles', 'slug'=>'show_roles']);
        Permission::create(['name'=>'Update Role', 'slug'=>'update_role']);
        Permission::create(['name'=>'Delete Role', 'slug'=>'cancel_role']);

        Permission::create(['name'=>'Create Permission', 'slug'=>'create_permission']);
        Permission::create(['name'=>'Show Permissions', 'slug'=>'show_permissions']);
        Permission::create(['name'=>'Update Permission', 'slug'=>'update_permission']);
        Permission::create(['name'=>'Delete Permission', 'slug'=>'delete_permission']);

        Permission::create(['name'=>'Create Address Type', 'slug'=>'create_address_type']);
        Permission::create(['name'=>'Show Address Type', 'slug'=>'show_address_type']);
        Permission::create(['name'=>'Update Address Type', 'slug'=>'update_address_type']);
        Permission::create(['name'=>'Delete Address Type', 'slug'=>'delete_address_type']);

        Permission::create(['name'=>'Create contact Type', 'slug'=>'create_contact_type']);
        Permission::create(['name'=>'Show Contact Type', 'slug'=>'show_contact_type']);
        Permission::create(['name'=>'Update Contact Type', 'slug'=>'update_contact_type']);
        Permission::create(['name'=>'Delete Contact Type', 'slug'=>'delete_contact_type']);
    }

    public function seed_addresstypes() {
        Addresstype::create(['name'=>'Home']);
        Addresstype::create(['name'=>'Work']);
        Addresstype::create(['name'=>'Delivery']);
    }

    public function seed_contacttypes() {
        Contacttype::create(['name'=>'Home']);
        Contacttype::create(['name'=>'Work']);
        Contacttype::create(['name'=>'Cell']);
    }

    public function seed_myuser() {
        User::create(['username'=>'admin',
                        'Name'=>'Administrator',
                        'email'=>'noreply@hwshop.co.za',
                        'password'=>'Adm1n@2020'
                    ]);

        $user = User::findOrFail(1);
        $role = Role::findOrFail(1);
        $user->roles()->attach($role);            
    }

    public function seed_users() {
        User::factory()
            ->count(50)
            ->hasPosts(2)
            ->create();
    }
}

/*->hasAddress(1)
->hasContact(1)*/