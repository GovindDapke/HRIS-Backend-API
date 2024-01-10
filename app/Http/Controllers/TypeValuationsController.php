<?php

namespace App\Http\Controllers;

use App\Models\TypeValuations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeValuationsController extends Controller
{
    public function index(Request $request)
    
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = TypeValuations::orderBy("type", "desc");
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
            'title' => ['required'],
            'type' => ['required','unique:type_valuations,type'],
            'is_active' => ['required'],
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new TypeValuations();
            $obj->title = $request->title;
            $obj->type = $request->type;
            $obj->is_active =$request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'type' => ['required'],
            'is_active' => ['required'],
            'valuation_id' => ['required', 'exists:type_valuations,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = TypeValuations::find($request->valuation_id);
            $obj->title = $request->title;
            $obj->type = $request->type;
            $obj->is_active =$request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            TypeValuations::whereId($request->valuation_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
