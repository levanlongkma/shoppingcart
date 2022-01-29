<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{

    public function getDistricts(Request $request)
    {
        $data['districts'] = District::where("matp",$request->matp)
                    ->get(["name","maqh"]);
        return response()->json($data);
    }
    public function getWards(Request $request)
    {
        $data['wards'] = Ward::where("maqh",$request->maqh)
                    ->get(["name","id"]);
        return response()->json($data);
    }

    // public function getDistricts() {
    //     $params = request()->all();

    //     try {
    //         if (data_get($params, 'matp')) {
    //             $districts = DB::select('SELECT maqh,name FROM devvn_quanhuyen WHERE matp = ?', [$params['matp']]);
                
    //             return [
    //                 'status' => true,
    //                 'districts' => $districts
    //             ];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e);

    //         return [
    //             'status' => false
    //         ];
    //     }
    // }

    // public function getWards() {
    //     $params = request()->all();
        
    //     try {
    //         if (data_get($params, 'maqh')) {
    //             $wards = DB::select('SELECT id,name FROM devvn_xaphuongthitran WHERE maqh = ?', [$params['maqh']]);
                
    //             return [
    //                 'status' => true,
    //                 'wards' => $wards
    //             ];
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e);

    //         return [
    //             'status' => false
    //         ];
    //     }
    // }
}
