<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {

        try {
            $is_active = $request->is_active ?? null;
            $data = Attendance::orderBy("id", "asc");
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
                'mood' => ['required'],
                'heart_rate' => ['required'],
                'spo2' => ['required'],
                'temperature' => ['required'],
                'employee_id' => ['required', 'exists:users,id']
            ]
        );

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $userObj = new Attendance;
            $userObj->mood = $request->mood;
            $userObj->spo2 = $request->spo2;
            $userObj->heart_rate = $request->heart_rate;
            $userObj->temperature = $request->temperature;
            $userObj->employee_id = $request->employee_id;
            $userObj->save();
            return apiReqponse($userObj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

   

    

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'attendance_id' => ['required','exists:users,id'],
            'mood' => ['required'],
            'heart_rate' => ['required'],
            'spo2' => ['required'],
            'temperature' => ['required'],
            'employee_id' => ['required', 'exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Attendance::find($request->attendance_id);
            $obj->mood = $request->mood;
            $obj->spo2 = $request->spo2;
            $obj->heart_rate = $request->heart_rate;
            $obj->temperature = $request->temperature;
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
            Attendance::whereId($request->attendance_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


    public function show(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'attendance_id' => ['required', 'exists:attendances,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Attendance::find($request->attendance_id);
            return apiReqponse($obj, true, DATA_FATCHED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }


   public function markAttendance(Request $request)
{
    try {
        // Validate the input fields
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'temperature' => 'required|numeric',
            'spo2' => 'required|numeric',
            'heart_rate' => 'required|numeric',
            'mood' => 'required|string',
        ]);

        $employee_id = $validatedData['employee_id'];
        // $date = Carbon::now()->format('Y-m-d');
        // $currentTime = Carbon::now();
        $date = Carbon::now()->toDateString();
        $currentTime = Carbon::now();

        // Update or create attendance record
        $attendance = Attendance::updateOrCreate(
            ['employee_id' => $employee_id, 'date' => $date],
            [
                'status' => 1,
                'temperature' => $validatedData['temperature'],
                'spo2' => $validatedData['spo2'],
                'heart_rate' => $validatedData['heart_rate'],
                'mood' => $validatedData['mood'],
                'login_time' => $currentTime,
                // 'created_at' => now()
            ]
        );

        // Success response
        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully',
            'data' => $attendance
        ]);

    } catch (\Exception $e) {
        // Error response
        Log::error("Error in marking attendance: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error in marking attendance',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function markLogout(Request $request)
    {
        // Retrieve user ID and current date
        $employee_id = auth()->user()->id;
        $date = Carbon::now()->toDateString();
        $currentTime = Carbon::now();

        // Find the attendance record
        $attendance = Attendance::where('employee_id', $employee_id)
                        ->where('date', $date)
                        ->first();

        // If attendance record is not found, return a 404 response
        if (!$attendance) {
            return response()->json(['message' => 'Attendance not found'], 404);
        }

        // Update the logout time for the attendance record
        $attendance->update(['logout_time' => $currentTime]);

        // Return success message
        return response()->json([
            'data'=>$attendance,
            'message' => 'Logout time recorded successfully'
        ]);
    }
   
}
