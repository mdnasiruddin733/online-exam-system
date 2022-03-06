<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments=["EEE","CSE","ME","CE","MME","BME","IPE","URP","NAME","MATH","ARCHITECTURE"];
        foreach($departments as $name){
            Department::create([
                "name"=>$name,
                "image"=>"img/department.png"
            ]);
        }
    }
}
