<?php

namespace App\Http\Controllers;

use App\ChartedWater;
use Illuminate\Http\Request;
use Exception;
use App\Helpers\IslandHelper;


class ChartedWaterController extends Controller
{
    public function index()
    {
        try {
            $islands = ChartedWater::all();
            foreach($islands as $island) {
                // Stored JSON as string due to using an SQLite DB. Needs to be decoded back into JSON for API response.
                $island->map = json_decode($island->map);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => true, 'code' => 500, 'message' => $e]);
        }

        return response()->json(['error' => false, 'code' => 200, 'islands' => $islands]);
    }

    public function create(Request $request)
    {
        if ($size = $request->get('islandSize')) { // Check if a custom islandSize has been defined and use it if it has.
            $islandHelper = new IslandHelper($size, $size);
        } else {
            $islandHelper = new IslandHelper();
        }

        $map = $islandHelper->makeMap(); // Make a new map
        $numberOfIslands = $islandHelper->countIslands($map); // Count the islands

        try {
            ChartedWater::create(['map' => json_encode($map), 'islands' => $numberOfIslands]); // Store in DB
        } catch (\Exception $e) {

            return response()->json(['error' => true, 'code' => 500, 'message' => $e->getMessage()]);
        }

        return response()->json(['error' => false, 'code' => 200, 'map' => $map, 'islands' => $numberOfIslands]);
    }
}
