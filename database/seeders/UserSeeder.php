<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Administrador";
        $user->email = "admin@mail.com";
        $user->password = bcrypt("admin54321");
        $user->save();

        $user = new User;
        $user->name = "Javier";
        $user->email = "javier@mail.com";
        $user->password = bcrypt("javier54321");
        $user->save();
    }
}
