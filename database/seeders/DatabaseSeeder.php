<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Item;
use App\Models\Product;
use App\Models\Station;
use App\Models\Task;
use App\Models\User;
use App\Models\Ware;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();
        Task::truncate();
        Ware::truncate();
        Activity::truncate();

        $user = [
            'firstname' => 'Mohammad',
            'lastname' => 'Merati',
            'username' => 'merati22',
            'phone' => '09121377898',
            'email' => 'merati22@gm.com',
            'password' => bcrypt('test123'),
            'access_level' => 'manager',
        ];

        User::insert($user);


    }
}
