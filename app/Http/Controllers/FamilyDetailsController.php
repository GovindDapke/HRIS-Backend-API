<?php

namespace App\Http\Controllers;

use App\Models\FamilyDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyDetailsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = FamilyDetails::orderBy("name", "asc");
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
            'name' => ['required'],
            'relationship' => ['required'],
            'date_of_birth' => ['required'],
            'occuption' => ['required'],
            'employee_id' => ['required','exists:users,id'],
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new FamilyDetails();
            $obj->name = $request->name;
            $obj->relationship = $request->relationship;
            $obj->date_of_birth = $request->date_of_birth;
            $obj->occuption = $request->occuption;
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
            'name' => ['required'],
            'relationship' => ['required'],
            'date_of_birth' => ['required'],
            'occuption' => ['required'],
            'family_details_id' => ['required','exists:family_details,id'],
            'employee_id' => ['required','exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = FamilyDetails::find($request->family_details_id);
            $obj->name = $request->name;
            $obj->relationship = $request->relationship;
            $obj->date_of_birth = $request->date_of_birth;
            $obj->occuption = $request->occuption;
            $obj->employee_id =$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            FamilyDetails::whereId($request->family_details_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'family_details_id' => ['required', 'exists:family_details,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = FamilyDetails::find($request->family_details_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
