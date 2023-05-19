<?php

namespace Tests\Feature;

use App\Models\Dog;
use Database\Seeders\DogsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DogsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_controller_returns_dogs_database_empty(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson('api/listDogs');

        $response->assertStatus(204);
    }
    public function test_controller_returns_all_dogs(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            DogsSeeder::class,
            DogsSeeder::class,
        ]);


        $response = $this->getJson('api/listDogs');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json());
    }

    public function test_controller_saves_dog(): void
    {
        $this->withoutExceptionHandling();
        $fakeDog = Dog::factory()->create();

        $response = $this->postJson('api/addDog', $fakeDog->toArray());

        $response->assertStatus(202);
    }

    public function test_controller_returns_error_on_wrong_json_format(): void
    {
        $this->withoutExceptionHandling();
        $fakeDog = Dog::factory()->create(['data' => 'wrong json']);

        $response = $this->postJson('api/addDog', $fakeDog->toArray());

        $response->assertStatus(422);
    }

    public function test_controller_returns_error_on_no_data(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('api/addDog', []);

        $response->assertStatus(422);
    }
}
