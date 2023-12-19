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

        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.update'])->assignRole($role1);

        Permission::create(['name' => 'admin.genders.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.genders.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.subgenders.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.subgenders.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.authors.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.authors.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.publishers.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.publishers.destroy'])->assignRole($role1);

        Permission::create(['name' => 'admin.books.index'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.books.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.books.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.books.destroy'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.book-purchase-details.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.book-purchase-details.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.book-purchase-details.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.book-purchase-details.destroy'])->syncRoles([$role1, $role2]);

    } 
}
