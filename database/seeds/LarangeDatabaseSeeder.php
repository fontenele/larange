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

        $users = array(
            ['name' => 'Guilherme Fontenele', 'email' => 'guilherme@fontenele.net', 'password' => Hash::make('secret')],
            ['name' => 'Simone Teles', 'email' => 'siteles2@gmail.com', 'password' => Hash::make('secret')],
            ['name' => 'Walter White', 'email' => 'ww@heisenberg.com', 'password' => Hash::make('secret')],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            \App\User::create($user);
        }

        $datetime = Carbon::now();

        $clients = [
            [
                'id' => 'client1id',
                'secret' => 'client1secret',
                'name' => 'client1',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
            [
                'id' => 'client2id',
                'secret' => 'client2secret',
                'name' => 'client2',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ],
        ];

        DB::table('oauth_clients')->insert($clients);

        Model::reguard();

		// $this->call('UserTableSeeder');
	}

}
