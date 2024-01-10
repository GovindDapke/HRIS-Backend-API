<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return[
            'employee_number',
            'name',
            'last_name',
            'email',
            'mobile',
            'date_of_joining',
            'password'
        ];
    }
   
    public function collection()
    {
        // return User::all();
        return User::select('employee_number','name','last_name','email','mobile','date_of_joining','password')->get();
    }
}
