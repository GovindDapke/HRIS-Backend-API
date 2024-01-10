<?php

namespace App\Http\Controllers;


use App\Models\Experience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function index(Request $request)
    
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = Experience::orderBy("id", "asc");
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
            'company_name' => ['required'],
            'position' => ['required'],
            'start_date' => ['required','date','date_format:Y-m-d'],
            'end_date' => ['required','date','date_format:Y-m-d'],
            'employee_id' => ['required', 'exists:users,id']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new Experience();
            $obj->company_name = $request->company_name;
            $obj->position = $request->position;
            $obj->start_date = $request->start_date;
            $obj->end_date = $request->end_date;
            $obj->description = $request->description;
            $obj->employee_id = $request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
          
            'experience_id' => ['required','exists:experiences,id'],
            'company_name' => ['required'],
            'position' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'employee_id' => ['required', 'exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Experience::find($request->experience_id);
            $obj->company_name = $request->company_name;
            $obj->position = $request->position;
            $obj->start_date = $request->start_date;
            $obj->end_date = $request->end_date;
            $obj->description = $request->description;
            $obj->employee_id = $request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete1(Request $request)
    {
        try {
            $a=Experience::whereId($request->experience_id)->delete();
            print_r($a);die;
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            Experience::whereId($request->experience_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'experience_id' => ['required']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Experience::find($request->experience_id);
            $obj->save();
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
