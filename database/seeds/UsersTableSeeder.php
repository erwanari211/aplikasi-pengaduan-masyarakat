<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Admin';
        $admin->email = 'admin@app.com';
        $admin->password = bcrypt('12345678');
        $admin->username = 'admin';
        $admin->is_admin = true;
        $admin->role = 'admin';
        $admin->save();

        $operator = new User;
        $operator->name = 'operator';
        $operator->email = 'operator@app.com';
        $operator->password = bcrypt('12345678');
        $operator->username = 'operator';
        $operator->is_admin = true;
        $operator->role = 'operator';
        $operator->save();

        $user = new User;
        $user->name = 'user1';
        $user->email = 'user1@app.com';
        $user->password = bcrypt('12345678');
        $user->username = 'user1';
        $user->is_admin = false;
        $user->role = 'user';
        $user->save();

        $user = new User;
        $user->name = 'user2';
        $user->email = 'user2@app.com';
        $user->password = bcrypt('12345678');
        $user->username = 'user2';
        $user->is_admin = false;
        $user->role = 'user';
        $user->save();

        $user = new User;
        $user->name = 'user3';
        $user->email = 'user3@app.com';
        $user->password = bcrypt('12345678');
        $user->username = 'user3';
        $user->is_admin = false;
        $user->role = 'user';
        $user->save();
    }
}
