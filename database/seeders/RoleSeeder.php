<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = new Role();
        $r1->nombre = "Admin";
        $r1->save();

        $r2 = new Role();
        $r2->nombre = "Gerente";
        $r2->save();

        $r3 = new Role();
        $r3->nombre = "User";
        $r3->save();

        // asignar permisos al rol
        $r1->allowTo("manage_all");

        $r2->allowTo("viewAny_user");
        $r2->allowTo("view_user");
        $r2->allowTo("create_user");
        $r2->allowTo("viewAny_role");
        $r2->allowTo("view_role");
        $r2->allowTo("create_role");

        $r3->allowTo("viewAny_user");
    }
}
