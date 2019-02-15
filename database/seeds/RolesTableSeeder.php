<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $admin = new Role();
        $admin->name="Админ";
        $admin->save();

        $vendor = new Role();
        $vendor->name="Торговый";
        $vendor->save();

        $superViewer = new Role();
        $superViewer->name="Супервайзер";
        $superViewer->save();
    }
}
