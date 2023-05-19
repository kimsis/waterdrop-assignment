<?php

namespace Tests\Feature;

use App\Models\Dog;
use Database\Seeders\DogsSeeder;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DogsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function getJsonRequest(string $uri): TestResponse
    {
        return $this->getJson($uri, ['Authorization' => env('API_KEY')]);
    }

    private function postJsonRequest(string $uri, array $data): TestResponse
    {
        return $this->postJson($uri, $data, ['Authorization' => env('API_KEY')]);
    }

    private function getJsonErrorMessage(TestResponse $response)
    {
        return json_decode($response->getContent())->message;
    }

    public function test_controller_returns_all_dogs(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            DogsSeeder::class,
            DogsSeeder::class,
        ]);


        $response = $this->getJsonRequest('api/listDogs');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json()['data']);
    }

    public function test_controller_returns_dogs_by_name(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            DogsSeeder::class,
            DogsSeeder::class,
        ]);


        $response = $this->getJsonRequest('api/listDogs?name=dogName');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json()['data']);
    }

    public function test_controller_returns_no_dogs_when_wrong_name(): void
    {
        $this->withoutExceptionHandling();
        $this->seed([
            DogsSeeder::class,
            DogsSeeder::class,
        ]);


        $response = $this->getJsonRequest('api/listDogs?name=Kevin');

        $response->assertStatus(200);
        $this->assertCount(0, $response->json()['data']);
    }

    public function test_controller_saves_dog(): void
    {
        $this->withoutExceptionHandling();
        $fakeDog = Dog::factory()->create();
        $fakeDog['data'] = json_encode($fakeDog['data']);

        $response = $this->postJsonRequest('api/addDog', $fakeDog->toArray());

        $response->assertContent('"Dog creation successfully started."');
    }

    public function test_controller_returns_error_on_wrong_json_format(): void
    {
        $this->withoutExceptionHandling();
        $fakeDog = Dog::factory()->create(['data' => 'wrong json']);

        $response = $this->postJsonRequest('api/addDog', $fakeDog->toArray());

        $response->assertJsonFragment(['message' => 'Incorrect JSON format for data property.']);
    }
}
