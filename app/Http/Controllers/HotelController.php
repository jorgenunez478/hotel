<?php
namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return Hotel::with('rooms')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:hotels',
            'tax_id' => 'required|unique:hotels',
            'city' => 'required|string',
            'address' => 'required|string',
            'nit' => 'required|unique:hotels',
            'max_rooms' => 'required|integer',
            'rooms' => 'required|array',
            'rooms.*.type' => 'required|in:Estándar,Junior,Suite',
            'rooms.*.accommodation' => 'required|in:Sencilla,Doble,Triple,Cuádruple',
            'rooms.*.quantity' => 'required|integer',
        ]);

        $totalRooms = array_sum(array_column($request->rooms, 'quantity'));
        if ($totalRooms > $request->max_rooms) {
            return response()->json(['error' => 'La cantidad de habitaciones configuradas supera el máximo permitido por hotel.'], 422);
        }

        $roomCombinations = [];
        foreach ($request->rooms as $room) {
            $combination = $room['type'] . '-' . $room['accommodation'];
            if (in_array($combination, $roomCombinations)) {
                return response()->json(['error' => 'No debe existir tipos de habitaciones y acomodaciones repetidas para el mismo hotel.'], 422);
            }
            $roomCombinations[] = $combination;
        }

        $hotel = Hotel::create($request->only('name', 'tax_id', 'city', 'address', 'nit', 'max_rooms'));

        foreach ($request->rooms as $room) {
            $hotel->rooms()->create($room);
        }

        return response()->json($hotel->load('rooms'), 201);
    }

    public function show($id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);
        return response()->json($hotel);
    }
}