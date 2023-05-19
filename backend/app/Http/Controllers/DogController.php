<?php

namespace App\Http\Controllers;

use App\Jobs\AsyncModelSave;
use App\Models\Dog;
use App\Responses\ValidationErrorResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|Collection
    {
        $response = Dog::all();
        if(sizeof($response) == 0)
        {
            return response('', 204);
        }

        return Dog::all();
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->input('data');
        $decoded = json_decode($data, true);

        if(is_null($decoded))
        {
            $errorResponse = new ValidationErrorResponse();
            return response()
                ->json($errorResponse->makeError('Incorrect JSON format for data property'))
                ->setStatusCode(422);
        }
        Validator::make([...$request->all(), ...$decoded], [
            'data' => 'required',
            'name' => 'required',
        ])->validate();

        AsyncModelSave::dispatch(Dog::class, $request->all());
        return response()
            ->json('Dog creation successfully started')
            ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
