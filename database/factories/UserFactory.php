<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition ()
    {
        return [
            "group_id" => 17,
            "date" => $this->faker->date("Y-m-d 00:00:00"),
            "homework" => $this->faker->text,
            "payment_status" => round(rand(1,3)),
            "student_id" => round(rand(50,100)),
            "lesson_theme" => $this->faker->text,
            "balance_lesson" =>  round(rand(500,150000)),
            "lesson_cost" =>  round(rand(300,1000)),
            "lesson_number" => round(rand(1,1500)),
        ];

    }
}
