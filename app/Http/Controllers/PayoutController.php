<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = Payout::orderBy("amount", "asc");
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

        $validation = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'employee_id' => ['required'],
                'amount' => ['required']
            ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {

            $obj = new Payout();
            $obj->amount = $request->amount;
            $obj->title =$request->title;
            $obj->employee_id =$request->employee_id;
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
            'payout_id' => ['required', 'unique:payouts,title,' . $request->payout_id],
            'is_active' => ['required']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Payout::find($request->payout_id);
            $obj->amount =$request->amount;
            $obj->title =$request->title;
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
            Payout::whereId($request->payout_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
