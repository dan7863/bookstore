<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Editor']);
        $role3 = Role::create(['name' => 'Viewer']);

        Permission::create(['name' => 'admin.home',
        'description' => 'See Dashboard'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.users.index',
        'description' => 'See Users List'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit',
        'description' => 'Assign a Role'])->assignRole($role1);

        Permission::create(['name' => 'admin.roles.index',
        'description' => 'See roles List'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.edit',
        'description' => 'Edit a Role'])->assignRole($role1);
        Permission::create(['name' => 'admin.roles.destroy',
        'description' => 'Delete a Role'])->assignRole($role1);


        Permission::create(['name' => 'admin.genders.index',
        'description' => 'See Genders List'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.create',
        'description' => 'Create a Gender'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.edit',
        'description' => 'Edit a Gender'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.destroy',
        'description' => 'Delete a Gender'])->assignRole($role1);

        Permission::create(['name' => 'admin.subgenders.index',
        'description' => 'See Subgenders List'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.create',
        'description' => 'Create a Subgender'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.edit',
        'description' => 'Edit a Subgender'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.destroy',
        'description' => 'Delete a Subgender'])->assignRole($role1);

        Permission::create(['name' => 'admin.authors.index',
        'description' => 'See Authors List'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.create',
        'description' => 'Create an Author'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.edit',
        'description' => 'Edit an Author'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.destroy',
        'description' => 'Delete an Author'])->assignRole($role1);

        Permission::create(['name' => 'admin.publishers.index',
        'description' => 'See Publishers List'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.create',
        'description' => 'Create a Publisher'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.edit',
        'description' => 'Edit a Publisher'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.destroy',
        'description' => 'Delete a Publisher'])->assignRole($role1);

        Permission::create(['name' => 'admin.books.index',
        'description' => 'See Books List'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.books.create',
        'description' => 'Load a Book'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.books.edit',
        'description' => 'Place a Book for Sale'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.books.destroy',
        'description' => 'Delete a Book'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.book-purchase-details.index',
        'description' => 'See Books in Selling List'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.book-purchase-details.edit',
        'description' => 'Edit Purchase Detail'])->syncRoles([$role1, $role2]);
    }
}
