<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->name(),
           "image"=>"img/student.png",
           "phone"=>$this->faker->phoneNumber(),
           "email"=>$this->faker->safeEmail(),
           "department_id"=>$this->faker->numberBetween(1,11),
           "roll"=>$this->faker->numberBetween(1600001,1600500),
           "password"=>bcrypt("123456")
        ];
    }
}
