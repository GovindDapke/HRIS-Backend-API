<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Egulias\EmailValidator\Result\Result;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\EmployeeIdHelper;
use EmployeeIdHelper as GlobalEmployeeIdHelper;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Http;

// use App\Helpers\Helper;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = User::with(['department:id,name', 'designation:id,name', 'attendance', 'role:id,name', 'userdocument', 'userasset', 'userleave', 'educationDetails', 'familyDetails'])->orderBy("name", "asc");
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
                'name' => ['required'],
                'mobile' => ['required', 'regex:/^[6789]\d{9}$/'],
                'email' => ['required', Rule::unique('users')->whereNull('deleted_at')],
                'is_active' => ['required'],
                'password' => ['required', 'string', 'min:8', 'regex:/[A-Za-z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
                'department_id' => ['required', 'exists:departments,id'],
                'date_of_birth' => ['required','date','date_format:Y-m-d'],
                'date_of_joining' => ['required','date','date_format:Y-m-d'],
            ]
        );

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {

            if ($request->role_id == 1 && $request->role_id == 2) {
                return apiReqponse('', false, ADMIN_ROLE, BAD_REQUEST);
            }
            $lastEmployee = User::orderBy('employee_number', 'desc')->first();
            $newEmployeeNumber = 'AXT1001';
            /* if ($lastEmployee) {
                // Increment the employee number
                $newEmployeeNumber = incrementEmployeeNumber($lastEmployee->employee_number);
            } */
            $userObj = new User;
            $userObj->employee_number = "AXT";
            $userObj->name = $request->name;
            $userObj->last_name = $request->last_name;
            $userObj->mobile = $request->mobile;
            $userObj->alternate_mobile_number = $request->alternate_mobile_number;
            $userObj->date_of_birth = $request->date_of_birth;
            $userObj->date_of_joining = $request->date_of_joining;
            $userObj->gender = $request->gender;
            $userObj->marital_status = $request->marital_status;
            $userObj->email = $request->email;
            $userObj->password = Hash::make($request->password);
            $userObj->role_id = $request->role_id;
            $userObj->is_active = $request->is_active ?? true;
            $userObj->address = $request->address;
            $userObj->department_id = $request->department_id;
            $userObj->designation_id = $request->designation_id;
            $userObj->save();
            $userObj->employee_number = 'AXT' . str_pad($userObj->id, 4, '0', STR_PAD_LEFT);
            $userObj->save();

            return apiReqponse($userObj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'employee_id' => ['required', 'exists:users,id'],
            'name' => ['required'],
            'mobile' => ['required', 'regex:/^[6789]\d{9}$/'],
            'email' => ['required', 'email'],
            'is_active' => ['required'],
            // 'password' =>  ['required', 'string', 'min:8', 'regex:/[A-Za-z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'department_id' => ['required', 'exists:departments,id'],
            'designation_id' => ['required', 'exists:designations,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = User::find($request->employee_id);
            $obj->name = $request->name;
            $obj->last_name = $request->last_name;
            $obj->mobile = $request->mobile;
            $obj->alternate_mobile_number = $request->alternate_mobile_number;
            $obj->date_of_birth = $request->date_of_birth;
            $obj->gender = $request->gender;
            $obj->marital_status = $request->marital_status;
            $obj->email = $request->email;
            $obj->role_id = $request->role_id;
            $obj->is_active = $request->is_active ?? true;
            $obj->address = $request->address;
            $obj->department_id = $request->department_id;
            $obj->designation_id = $request->designation_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function delete(Request $request)
    {
        try {
            User::whereId($request->employee_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'employee_id' => ['required', 'exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = User::with(['familyDetails', 'department:id,name', 'designation:id,name', 'attendance', 'role:id,name', 'userdocument', 'userasset', 'userleave', 'educationDetails'])->find($request->employee_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }



    public function import(Request $request)
    {
        $file = $request->file('excel_file');
        // print_r($file);die;
        $this->validate($request, [
            'excel_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new UsersImport, $file);
            return redirect()->back()->with('success', ' imported data: ');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error importing data: ', $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function device(Request $request)
    {
        
        $employee_id = $request->employee_id ?? auth()->id();
        $data = User::orderBy("id", "asc")->where('employee_id', $employee_id);
        $theUrl = config('http://192.168.0.158:5000/start_registration');
        $response= Http::post($theUrl, [
            '$employee_id'=>$request->name,
            'email'=>$request->email
        ]);
        return $response;

    }
}
