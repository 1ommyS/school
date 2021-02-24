<?php

namespace Database\Factories;

use App\Models\AuxPayments;
use App\Models\Lesson;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition ()
    {
        return [
           "student_id" => round(rand(62,63)),
            "group_id" => 108,
            "mark" => round(rand(6,15)),
            "created_at" => "2021-".round(rand(1,12))."-".round(rand(1,31)),
            "updated_at" => now()
        ];

    }
}
