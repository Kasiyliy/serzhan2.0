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
        $accepted->name = 'В складе';
        $accepted->save();

        $unaccepted = new Status();
        $unaccepted->name = 'Не в складе';
        $unaccepted->save();

        $hidden = new Status();
        $hidden->name = 'Скрыт';
        $hidden->save();
    }
}
