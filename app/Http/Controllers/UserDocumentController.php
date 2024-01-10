<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDocumentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $employee_id = $request->employee_id ?? auth()->id();
            $data = UserDocument::orderBy("id", "asc")->where('employee_id', $employee_id);
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
            'front_image' => ['required'],
            'id_number' => ['required'],
            'document_id' => ['required', 'exists:documents,id'],
            'employee_id' => ['required', 'exists:users,id']

        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new UserDocument();
            $obj->front_image = $request->front_image;
            $obj->back_image = $request->back_image;
            $obj->id_number = $request->id_number;
            $obj->employee_id = $request->employee_id;
            $obj->document_id = $request->document_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'user_document_id' => ['required','exits:user_documents,id'],
            'front_image' => ['required'],
            'id_number' => ['required'],
            'document_id' => ['required', 'exists:documents,id'],
            // 'employee_id'=>['required','exits:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserDocument::find($request->user_document_id);
            $obj->front_image = $request->front_image;
            $obj->back_image = $request->back_image;
            $obj->id_number = $request->id_number;
            $obj->document_id = $request->document_id;
            $obj->employee_id = $request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            UserDocument::whereId($request->user_document_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_document_id' => ['required', 'exists:user_documents,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserDocument::find($request->education_details_id);
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function show1(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'bank_details_id' => ['required', 'exists:bank_details,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserDocument::find($request->bank_details_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
