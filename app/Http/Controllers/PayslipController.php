<?php

namespace App\Http\Controllers;

use App\Models\PaySlip;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayslipController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_active = $request->is_active ?? null;
            $employee_id = $request->employee_id ?? auth()->id();
            $data = PaySlip::orderBy("month", "asc")->where('employee_id', $employee_id);
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
                'image' => ['required'],
                'employee_id' => ['required'],
                'month' => ['required']
            ]
        );

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {

            $obj = new PaySlip();
            $obj->month = $request->month;
            $obj->image = $request->image;
            $obj->employee_id = $request->employee_id;
            // $obj->is_active = $request->is_active;
            $obj->save();


            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }



    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'payslip_id' => ['required'],
            'month' => ['required']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = PaySlip::find($request->payslip_id);
            $obj->image = $request->image;
            $obj->month = $request->month;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            PaySlip::whereId($request->payslip_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }



    public function downloadPDF()
    {
        // Your PDF content goes here
        $data = [
            'title' => 'Sample PDF',
            'content' => 'This is a sample PDF file generated in Laravel.',
        ];

        $pdf = PDF::loadView('payslip', $data);

        return $pdf->download('sample.pdf');
    }
}

