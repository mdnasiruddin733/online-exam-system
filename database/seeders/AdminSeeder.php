<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=Admin::create([
            "name"=>"Mr. Admin",
            "email"=>"admin@gmail.com",
            "phone"=>"017xxxxxxxx",
            "password"=>bcrypt("123456")
        ]);
    }
}
