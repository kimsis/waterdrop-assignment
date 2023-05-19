<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use stdClass;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeData = new stdClass();
        $fakeData->name = 'dogName'.rand();
        $fakeData->breed = 'dogBreed'.rand();
        return [
            'data' => json_encode($fakeData),
        ];
    }
}
