<?php

namespace App\Http\Controllers;

use App\Models\ExpensesType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesTypeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = ExpensesType::orderBy("name", "asc");
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
            'name' => ['required', 'unique:expenses_types'],
            'is_active' => ['required']
            
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new ExpensesType();
            $obj->name = $request->name;
            $obj->is_active = $request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'unique:expenses_types,name,' . $request->expenses_type_id],
            'is_active' => ['required'],
            'expenses_type_id' => ['required', 'exists:expenses_types,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = ExpensesType::find($request->expenses_type_id);
            $obj->name = $request->name;
            $obj->is_active = $request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            ExpensesType::whereId($request->expenses_type_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
