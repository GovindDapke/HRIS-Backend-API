<?php

namespace App\Http\Controllers;

use App\Models\EducationDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationDetailsController extends Controller
{
    public function index(Request $request)

    {
        try {
            $is_active = $request->is_active ?? null;
            $employee_id = $request->employee_id ?? auth()->id();
            $data = EducationDetail::orderBy("degree", "asc")->where('employee_id', $employee_id);
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
            'employee_id' => ['required', 'exists:users,id'],
            'degree' => ['required'],
            'institution' => ['required'],
            'graduation_year' => ['required'],
            'percentage' => ['required']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new EducationDetail();
            $obj->employee_id = $request->employee_id;
            $obj->degree = $request->degree;
            $obj->institution = $request->institution;
            $obj->graduation_year = $request->graduation_year;
            $obj->percentage = $request->percentage;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'employee_id' => ['required', 'exists:users,id'],
            'degree' => ['required'],
            'institution' => ['required'],
            'graduation_year' => ['required'],
            'percentage' => ['required']
            // 'department_id' => ['required', 'exists:departments,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = EducationDetail::find($request->education_details_id);
            $obj->employee_id = $request->employee_id;
            $obj->degree = $request->degree;
            $obj->institution = $request->institution;
            $obj->graduation_year = $request->graduation_year;
            $obj->percentage = $request->percentage;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    // public function destroy(Request $request , $id)
    // {
    //     $validation = Validator::make($request->all(), [
    //         // 'id' => ['required']
    //     ]);

    //     if ($validation->fails()) {
    //         $error = $validation->errors()->first();
    //         return apiReqponse('', false, $error, BAD_REQUEST);
    //     }
    //     try {
    //         $obj = EducationDetail::where('id',$id)->delete();
    //         return apiReqponse($obj, true, DATA_DELETED, STATUS_OK);
    //     } catch (Exception $e) {
    //         return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
    //     }
    // }
    public function destroy(Request $request)
    {
        try {
            EducationDetail::find($request->education_details_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'education_details_id' => ['required', 'exists:education_details,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = EducationDetail::find($request->education_details_id);
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
