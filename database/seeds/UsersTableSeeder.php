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

        $users = [
            [
                'surname'    => 'Ivanov',
                'name'       => 'Ivan',
                'patronymic' => 'Ivanovich',
                'group'      => null,
                'role'       => 'mentor'
            ],
            [
                'surname'    => 'Viacheslav',
                'name'       => 'Sheviakov',
                'patronymic' => 'Igorevich',
                'group'      => 1,
                'role'       => 'student',
                'chat_id'    => '280739345'
            ],
            [
                'surname'    => 'Valuyskiy',
                'name'       => 'Vladislav',
                'patronymic' => 'Evgenievich',
                'group'      => 1,
                'role'       => 'student',
                'chat_id'    => '348939131'
            ],
            [
                'surname'    => 'Gavrilyuk',
                'name'       => 'Mykhailo',
                'patronymic' => 'Vikentiyevich',
                'group'      => 1,
                'role'       => 'student'
            ],
            [
                'surname'    => 'Moklyak',
                'name'       => 'Yaroslav',
                'patronymic' => 'Batkovich',
                'group'      => 1,
                'role'       => 'student',
                'chat_id'    => '291382399'
            ],
            [
                'surname'    => 'Maksimov',
                'name'       => 'Aleksey',
                'patronymic' => 'Lavrentievich',
                'group'      => 1,
                'role'       => 'student'
            ],
        ];

        foreach($users as $person)
        {
            self::fillUp($person);
        }
    }

    protected function fillUp($data)
    {
        $user = new User();

        $user->name       = $data['name'];
        $user->surname    = $data['surname'];
        $user->patronymic = $data['patronymic'];
        $user->group_id   = $data['group'];
        $user->email      = strtolower($data['name']).'.'.strtolower($data['surname']).'@ukr.net';
        $user->password   = bcrypt('123456');
        $user->chat_id    = isset($data['chat_id']) ? $data['chat_id'] : null;

        $user->save();

        $user->roles()->attach(Role::all()->where('name', $data['role'])->first()->id);
    }
}
