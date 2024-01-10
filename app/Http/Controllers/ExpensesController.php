<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = Expenses::orderBy("image", "asc");
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
            'image' => ['required'],
            'employee_id' => ['required','exists:users,id'],
            'expenses_type_id' => ['required','exists:expenses_types,id']   
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new Expenses();
            $obj->image = $request->image;
            $obj->employee_id =$request->employee_id;
            $obj->expenses_type_id =$request->expenses_type_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'expenses_id' => ['required', 'exists:expenses,id'],
            'image' => ['required'],
            'employee_id' => ['required','exists:users,id'],
            'expenses_type_id' => ['required','exists:expenses_types,id']   
        ]);
        
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Expenses::find($request->expenses_id);
            $obj->image = $request->image;
            $obj->employee_id =$request->employee_id;
            $obj->expenses_type_id =$request->expenses_type_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            Expenses::whereId($request->expenses_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
