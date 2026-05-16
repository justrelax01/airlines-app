<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        if ($request->filled('from')) {
            $query->where('origin', 'like', '%' . $request->from . '%');
        }

        if ($request->filled('to')) {
            $query->where('destination', 'like', '%' . $request->to . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json(
            $query->where('status', 'scheduled')
                  ->orderBy('departure_time')
                  ->paginate(20)
        );
    }

    public function show(Flight $flight)
    {
        return response()->json($flight);
    }
}
