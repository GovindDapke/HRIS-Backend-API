<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\TypeRates;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeRateController extends Controller
{
    public function index(Request $request)
    
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = TypeRates::orderBy("id", "asc");
            if (!empty($is_active)) {
                $data = $data->where("is_active", $is_active);
            }
            $data = $data->get();
            return apiReqponse($data, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'amount' => ['required'],
            'valuation_id' => ['required', 'exists:type_valuations,id']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new TypeRates();
            $obj->amount = $request->amount;
            $obj->valuation_id = $request->valuation_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'amount' => ['required'],
           'valuation_id' => ['required', 'exists:type_valuations,id'],
            'rate_id' => ['required', 'exists:type_rates,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = TypeRates::find($request->rate_id);
            $obj->amount = $request->amount;
            $obj->valuation_id = $request->valuation_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function delete(Request $request)
    {
        try {
            TypeRates::whereId($request->rate_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
