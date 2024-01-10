<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request)
    
    {
        try {
            $is_active = $request->is_active ?? null;
            $data = Ticket::orderBy("message", "asc");
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
            'message' => ['required'],
            'ticket_type_id' => ['required','ticket_types:users,id'],
            'employee_id'=>['required','exists:users,id']
        ]);
        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = new Ticket();
            $obj->ticket_type_id =$request->ticket_type_id;
            $obj->message =$request ->message;
            $obj->employee_id=$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_STORE, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

   
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'ticket_id' => ['required'],
            'message' => ['required'],
            'ticket_type_id' => ['required','ticket_types:users,id'],
            'employee_id'=>['required','exists:users,id']
        ]);

        if ($validation->fails()) {
            $error = $validation->errors()->first();
            return apiReqponse('', false, $error, BAD_REQUEST);
        }
        try {
            $obj = Ticket::find($request->ticket_id);
            $obj->ticket_type_id =$request->ticket_type_id;
            $obj->message =$request ->message;
            $obj->employee_id=$request->employee_id;
            $obj->save();
            return apiReqponse($obj, true, DATA_UPDATED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }

    public function delete(Request $request)
    {
        try {
            Ticket::whereId($request->ticket_id)->delete();
            return apiReqponse('', true, DATA_DELETED, STATUS_OK);
        } catch (Exception $e) {
            return apiReqponse('', false, $e->getMessage(), BAD_REQUEST);
        }
    }
}
