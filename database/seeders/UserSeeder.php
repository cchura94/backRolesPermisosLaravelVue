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
        $user1 = new User;
        $user1->name = "Administrador";
        $user1->email = "admin@mail.com";
        $user1->password = bcrypt("admin54321");
        $user1->save();

        $user2 = new User;
        $user2->name = "Javier";
        $user2->email = "javier@mail.com";
        $user2->password = bcrypt("javier54321");
        $user2->save();

        $user3 = new User;
        $user3->name = "Carlos";
        $user3->email = "carlos@mail.com";
        $user3->password = bcrypt("carlos54321");
        $user3->save();

        // asignar roles
        $user1->assignRole("Admin");
        $user2->assignRole("Gerente");
        $user3->assignRole("User");


    }
}
