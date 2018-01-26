<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to manage and edit everything';
        $admin->save();

        $mentor = new Role();
        $mentor->name         = 'mentor';
        $mentor->display_name = 'Students Mentor';
        $mentor->description  = 'User is allowed to manage tasks for students';
        $mentor->save();

        $student = new Role();
        $student->name         = 'student';
        $student->display_name = 'Student';
        $student->description  = 'User is allowed to accomplish tasks and write reports';
        $student->save();
    }
}
