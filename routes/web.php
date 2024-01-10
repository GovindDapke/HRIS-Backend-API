<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayslipController;
use App\Models\PaySlip;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "<h1 style='text-align:center;color:#cd1d37;margin-top:20%;'>Welcome to Health Care</h1>";
});

// Route::get('category', [HealthController::class, 'index']);






Route::get('/import', function () {
    return view('import');
});

Route::post('/import-excel', [EmployeeController::class, 'import'])->name('import.excel');
Route::get('users/export/', [EmployeeController::class, 'export'])->name('export-user');
Route::get('/payslip', function () {
    return view('payslip');
});

Route::get('/download-pdf', [PayslipController::class, 'downloadPDF']);