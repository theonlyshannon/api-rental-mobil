<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Car::query();

            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $cars = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Success retrieve all cars',
                'data' => CarResource::collection($cars),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed retrieve all cars',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarStoreRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('cars', 'public');
                $data['image'] = $imagePath;
            }

            $car = Car::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Car created',
                'data' => new CarResource($car),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Car failed to create',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $car = Car::find($id);

            if (!$car) {
                return response()->json([
                    'success' => false,
                    'message' => 'Car not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Success retrieve car',
                'data' => new CarResource($car),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed retrieve car',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            Log::info('Data yang diterima: ', $data);

            $car = Car::find($id);

            if (!$car) {
                return response()->json([
                    'success' => false,
                    'message' => 'Car not found',
                ], 404);
            }

            Log::info('Data sebelum update: ', $car->toArray());

            if ($request->hasFile('image')) {
                if ($car->image && Storage::exists('public/' . $car->image)) {
                    Storage::delete('public/' . $car->image);
                }

                $imagePath = $request->file('image')->store('cars', 'public');
                $data['image'] = $imagePath;
            }

            $car->update($data);

            Log::info('Data setelah update: ', $car->refresh()->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Car updated',
                'data' => new CarResource($car),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error saat update: ', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Car failed to update',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $car = Car::find($id);

            if (!$car) {
                return response()->json([
                    'success' => false,
                    'message' => 'Car not found',
                ], 404);
            }

            $car->delete();

            return response()->json([
                'success' => true,
                'message' => 'Car deleted',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Car failed to delete',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
