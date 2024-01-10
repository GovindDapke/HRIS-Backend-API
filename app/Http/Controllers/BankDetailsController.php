<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankDetailsController extends Controller
{
    public function index(Request $request)
    
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = BankDetail::orderBy("bank_name", "asc");
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
            'bank_name' => ['required'],
            'holder_name' => ['required'],
            'account_number' => ['required','regex:/^[0-9]{12}$/'],
            'ifsc_code' => ['required','regex:/^[A-Za-z]{4}0[A-Z0-9]{6}$/'],
            'employee_id' => ['required']

        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new BankDetail();
           
            $obj->bank_name =$request->bank_name;
            $obj->holder_name =$request->holder_name;
            $obj->account_number =$request->account_number;
            $obj->ifsc_code =$request ->ifsc_code;
            $obj->employee_id=$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

   
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            
            'bank_details_id' => ['required'],
            'bank_name' => ['required'],
            'holder_name' => ['required'],
            'account_number' => ['required','regex:/^[0-9]{12}$/'],
            'ifsc_code' => ['required','regex:/^[A-Za-z]{4}0[A-Z0-9]{6}$/'],
            'employee_id' => ['required']
            
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = BankDetail::find($request->bank_details_id);
            $obj->bank_name =$request->bank_name;
            $obj->holder_name =$request->holder_name;
            $obj->account_number =$request->account_number;
            $obj->ifsc_code =$request ->ifsc_code;
            $obj->employee_id=$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            BankDetail::whereId($request->bank_details_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'bank_details_id' => ['required', 'exists:bank_details,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = BankDetail::find($request->bank_details_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
