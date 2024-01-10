<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'employee_number' =>$row[0],
            'name' =>$row[1],
            'last_name' =>$row[2],
            'date_of_birth' =>$row[3],
            'gender' =>$row[4],
            'email' =>$row[5],
            'marital_status' =>$row[6],
            'mobile' =>$row[7],
            'alternate_mobile_number' =>$row[8],
            'password' =>$row[9],
            'address' =>$row[10],
        ]);
    }
}
