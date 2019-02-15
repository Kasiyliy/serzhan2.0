<?php

use Illuminate\Database\Seeder;
use App\Status;
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accepted = new Status();
        $accepted->name = 'Принят';
        $accepted->save();

        $unaccepted = new Status();
        $unaccepted->name = 'Не принят';
        $unaccepted->save();

        $hidden = new Status();
        $hidden->name = 'Скрыт';
        $hidden->save();
    }
}
