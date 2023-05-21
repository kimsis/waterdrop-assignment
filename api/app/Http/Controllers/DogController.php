<?php

namespace App\Http\Controllers;

use App\Jobs\AsyncModelSave;
use App\Models\Dog;
use App\Responses\ValidationErrorResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|LengthAwarePaginator
    {
        $name = $request->input('name');
        return $name
            ? Dog::where('data->name', 'like', '%'.$name.'%')->paginate(30)
            : Dog::paginate(30);
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->get('data');
        $decoded = json_decode($data, true);
        if(is_null($decoded))
        {
            $errorResponse = new ValidationErrorResponse();
            return response()
                ->json($errorResponse->makeError('Incorrect JSON format for data property.'))
                ->setStatusCode(422);
        }
        Validator::make($decoded, [
            'name' => 'required',
        ])->validate();

        $input = ['data' => $decoded];
        AsyncModelSave::dispatch(Dog::class, $input);

        return response()
            ->json('Dog creation successfully started.')
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
