<?php

namespace App\Http\Controllers;

use App\Models\UserLeave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;

class UserLeaveController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $employee_id = $request->employee_id ?? auth()->id();
            $data = UserLeave::orderBy("id", "asc")->where('employee_id', $employee_id);
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
            'employee_id'=>['required'],
            'reason' =>['required'],
            'date'=>['required'],
            'leave_id'=>['required','exists:leaves,id']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new UserLeave();
            $obj->employee_id = $request->employee_id;
            $obj->reason = $request->reason;
            $obj->date = $request->date;
            $obj->leave_id = $request->leave_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_leave_id' => ['required','exists:users,id'],
            'employee_id'=>['required','exists:users,id'],
            'reason' =>['required'],
            'date'=>['required'],
            'leave_id'=>['required','exists:leaves,id']
            
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserLeave::find($request->user_leave_id);
            $obj->employee_id = $request->employee_id;
            $obj->reason = $request->reason;
            $obj->date = $request->date;
            $obj->leave_id = $request->leave_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            UserLeave::whereId($request->user_leave_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_leave_id' => ['required', 'exists:user_leaves,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserLeave::find($request->user_leave_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
