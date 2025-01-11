<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Reservation::query();

            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $reservations = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Success retrieve all reservations',
                'data' => ReservationResource::collection($reservations),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed retrieve all reservations',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $reservation = Reservation::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Reservation created',
                'data' => new ReservationResource($reservation),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation failed to create',
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
            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reservation not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Success retrieve reservation',
                'data' => new ReservationResource($reservation),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed retrieve reservation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationUpdateRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            Log::info('Data yang diterima: ', $data);

            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reservation not found',
                ], 404);
            }

            Log::info('Data sebelum update: ', $reservation->toArray());

            $reservation->update($data);

            Log::info('Data setelah update: ', $reservation->refresh()->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Reservation updated',
                'data' => new ReservationResource($reservation),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error saat update: ', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Reservation failed to update',
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
            $reservation = Reservation::find($id);

            if (!$reservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reservation not found',
                ], 404);
            }

            $reservation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Reservation deleted',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation failed to delete',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
