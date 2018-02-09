<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id         = 1;
        $user->name       = 'Admin';
        $user->surname    = 'Admin';
        $user->patronymic = 'Admin';
        $user->email      = 'admin@gmail.com';
        $user->password   = bcrypt('admin');
        $user->save();

        $user->roles()->attach(Role::all()->where('name', 'admin')->first()->id);
    }
}
