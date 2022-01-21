<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function getDistricts() {
        $params = request()->all();

        try {
            if (data_get($params, 'province_id')) {
                $districts = DB::select('SELECT id,name FROM districts WHERE province_id = ?', [$params['province_id']]);
                
                return [
                    'status' => true,
                    'districts' => $districts
                ];
            }
        } catch (\Exception $e) {
            Log::error($e);

            return [
                'status' => false
            ];
        }
    }

    public function getWards() {
        $params = request()->all();
        
        try {
            if (data_get($params, 'district_id')) {
                $wards = DB::select('SELECT id,name FROM wards WHERE district_id = ?', [$params['district_id']]);
                
                return [
                    'status' => true,
                    'wards' => $wards
                ];
            }
        } catch (\Exception $e) {
            Log::error($e);

            return [
                'status' => false
            ];
        }
    }
}
