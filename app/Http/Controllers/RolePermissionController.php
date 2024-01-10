<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = RolePermission::orderBy("name", "asc");
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
            'name' => ['required', 'unique:assets'],
            'is_active' => ['required']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new RolePermission();
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
            'name' => ['required', 'unique:role,name,' . $request->role_permission_id],
            'is_active' => ['required'],
            'role_permission_id' => ['required', 'exists:role_permissions,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = RolePermission::find($request->role_permission_id);
            $obj->name = $request->name;
            $obj->is_active = $request->is_active;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
    public function assignPermission(Request $request){
        {
        $validation = Validator::make($request->all(), [
            'role_permission_id' => ['required', 'exists:role_permission,id'],
            'permission_id' => ['required']

        ]);
        if ($validation->fails()) {
 
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $permissions = $request->permission_id ?? [];
            RolePermission::where('role_permission_id', $request->role_permission_id)->delete();
            foreach ($permissions as $permission_id) {
                $rp = new RolePermission;
                $rp->role_id = $request->role_id;
                $rp->permission_id = $permission_id;
                $rp->save();
            }
            return apiReqponse('', true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
    }
    public function delete(Request $request)
    {
        try {
            RolePermission::whereId($request->role_permission_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
