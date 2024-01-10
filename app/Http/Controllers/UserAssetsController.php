<?php

namespace App\Http\Controllers;

use App\Models\UserAsset;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAssetsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $employee_id = $request->employee_id ?? auth()->id();
            $data = UserAsset::orderBy("id", "asc")->where('employee_id', $employee_id);
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
            'code'=>['required'],
            'asset_id'=>['required','exists:assets,id'],
            'employee_id'=>['required','exists:users,id']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new UserAsset();
            $obj->code = $request->code;
            $obj->asset_id = $request->asset_id;
            $obj->employee_id =$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_asset_id' => ['required', 'exists:user_assets,id'],
            'code'=>['required'],
            'asset_id'=>['required','exists:assets,id'],
            'employee_id'=>['required','exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserAsset::find($request->user_asset_id);
            $obj->code = $request->code;
            // $obj->is_active = $request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            UserAsset::whereId($request->user_asset_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_asset_id' => ['required', 'exists:user_assets,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = UserAsset::find($request->user_asset_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}

