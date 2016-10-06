<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        $datetime = \Carbon\Carbon::now();

        // Roles
        $roles = [
            ['id' => 666, 'name' => 'SuperAdmin', 'label' => 'Super Administrator', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['id' => 333, 'name' => 'Admin', 'label' => 'Administrator', 'created_at' => $datetime, 'updated_at' => $datetime],
        ];
        DB::table('roles')->insert($roles);

        // Users
        $users = [
            ['name' => 'Guilherme Fontenele', 'email' => 'guilherme@fontenele.net', 'password' => Hash::make('secret'), 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Simone', 'email' => 'siteles@fontenele.net', 'password' => Hash::make('secret'), 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Walter White', 'email' => 'ww@heisenberg.com', 'password' => Hash::make('secret'), 'created_at' => $datetime, 'updated_at' => $datetime],
        ];
        DB::table('users')->insert($users);
        
        // Add Roles to Users
        $user_roles = [
            ['roles_id' => 666, 'user_id' => 1],
            ['roles_id' => 333, 'user_id' => 1],
            ['roles_id' => 333, 'user_id' => 2],
        ];
        DB::table('roles_user')->insert($user_roles);
        
        // Permissions
        $permisisons = [
            ['name' => 'users.list', 'label' => 'List Users', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'users.edit', 'label' => 'Edit/Create Users', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'users.delete', 'label' => 'Delete Users', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'roles.list', 'label' => 'List Roles', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'roles.edit', 'label' => 'Edit/Create Roles', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'roles.delete', 'label' => 'Delete Roles', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'permissions.list', 'label' => 'List Permissions', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'permissions.edit', 'label' => 'Edit/Create Permissions', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'permissions.delete', 'label' => 'Delete Permissions', 'created_at' => $datetime, 'updated_at' => $datetime],
        ];
        DB::table('permissions')->insert($permisisons);
        
        // Add Permissions to Roles
        $roles_permisisons = [
            ['roles_id' => 666, 'permissions_id' => 1],
            ['roles_id' => 666, 'permissions_id' => 2],
            ['roles_id' => 666, 'permissions_id' => 3],
            ['roles_id' => 666, 'permissions_id' => 4],
            ['roles_id' => 666, 'permissions_id' => 5],
            ['roles_id' => 666, 'permissions_id' => 6],
            ['roles_id' => 666, 'permissions_id' => 7],
            ['roles_id' => 666, 'permissions_id' => 8],
            ['roles_id' => 666, 'permissions_id' => 9],
            ['roles_id' => 333, 'permissions_id' => 1],
        ];
        DB::table('permissions_roles')->insert($roles_permisisons);

        // Clients OAuth
        $clients = [
            ['id' => 'GXvOWazQ3lA6YSaFji', 'secret' => '#.:s.e.c.r.e.t:.#', 'name' => 'ClientWeb', 'created_at' => $datetime, 'updated_at' => $datetime]
        ];
        DB::table('oauth_clients')->insert($clients);

        Model::reguard();
	}

}
