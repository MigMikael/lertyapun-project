<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\StringGenerator;
use Carbon\Carbon;
class TestController extends Controller
{
    public function index(Request $request)
    {
        // $stringGenerator = new StringGenerator('0123456789');
        // $newSlug = $stringGenerator->generate(12);
        // // Log::info($request->all());
        // return $newSlug;
        // dd(Carbon::now());
        $shipmentRate = config('constants.shipmentRate');
        // $weight = 4180;
        $weight = 599;
        $weightKg = $weight / 1000;
        $weightFloor = floor($weightKg);
        $shipmentPrice = $shipmentRate[$weightFloor];

        $last = end($shipmentRate);
        return [$weight, $weightKg, $weightFloor, $shipmentPrice, $last];
    }
}
