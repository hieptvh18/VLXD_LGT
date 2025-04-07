<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    public function getProvinces()
    {
        $provinces = Province::all();

        return response()->json([
            'data' => $provinces
        ]);
    }

    public function getDistrictByProvinceId($provinceId)
    {
        $district = District::where('provinceid', $provinceId)->get();

        return response()->json([
            'province_id' => $provinceId,
            'data' => $district
        ]);
    }

    public function getWardByDistrictId($districtId)
    {
        $district = Ward::where('districtid', $districtId)->get();

        return response()->json([
            'district_id' => $districtId,
            'data' => $district?->map(function($item, $key) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'districtid' => $item->districtid,
                    'wardid' => $item->wardid,
                    'key' => $key
                ];
            })
        ]);
    }

    /**
     *
     * get data for box search select 2
     * @param $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrict(Request $request)
    {
        $provinceId = $request->city ?? null;

        if(!$provinceId) {
            return response()->json([], 404);
        }

        $district = District::where('provinceid', $provinceId)->get();
        $result = $district?->map(function($item) use ($provinceId) {
            return [
                'id' => $item->districtid,
                'text' => $item->name,
                'provinceid' => $provinceId,
            ];
        });

        return response()->json($result);
    }

    /**
     *
     * get data for box search select 2
     * @param $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWard(Request $request)
    {
        $districtId = $request->district ?? null;

        if(!$districtId) {
            return response()->json([], 404);
        }

        $ward = Ward::where('districtid', $districtId)->get();
        $result = $ward?->map(function($item) use ($districtId) {
            return [
                'id' => $item->districtid,
                'text' => $item->name,
                'districtid' => $districtId,
            ];
        });

        return response()->json($result);
    }
}
