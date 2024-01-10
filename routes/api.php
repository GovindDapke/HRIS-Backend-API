<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EducationDetailsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ExpensesDetailController;
use App\Http\Controllers\ExpensesTypeController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FamilyDetailsController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TypeRateController;
use App\Http\Controllers\TypeValuationsController;
use App\Http\Controllers\UserAssetsController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\UserLeaveController;
use App\Models\FamilyDetails;
use Illuminate\Support\Facades\Route;
use Psy\Command\ListCommand;

//user routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('password/email',  [AuthController::class, 'sendMail']);
    Route::post('password/verify', [AuthController::class, 'verifyOTP']);
});
Route::group(['middleware' => ['auth:api']], function () {

    //department
    Route::group(['prefix' => 'department'], function () {
        Route::post('list', [DepartmentController::class, 'index']);
        Route::post('create', [DepartmentController::class, 'store']);
        Route::post('update', [DepartmentController::class, 'update']);
        Route::post('delete', [DepartmentController::class, 'delete']);
    });

    //user
    Route::group(['prefix' => 'employee'], function () {
        Route::post('list', [EmployeeController::class, 'index']);
        Route::post('create', [EmployeeController::class, 'store']);
        Route::post('update', [EmployeeController::class, 'update']);
        Route::post('delete', [EmployeeController::class, 'delete']);
        Route::post('show', [EmployeeController::class, 'show']);
        Route::post('import', [EmployeeController::class, 'import']);
        Route::post('export', [EmployeeController::class, 'export']);
    });
// Family details
    Route::group(['prefix' => 'family-details'], function () {
        Route::post('list', [FamilyDetailsController::class, 'index']);
        Route::post('create', [FamilyDetailsController::class, 'store']);
        Route::post('update', [FamilyDetailsController::class, 'update']);
        Route::post('delete', [FamilyDetailsController::class, 'delete']);
        Route::post('show', [FamilyDetailsController::class, 'show']);
    });
    //leave
    Route::group(['prefix' => 'leave'], function () {
        Route::post('list', [LeaveController::class, 'index']);
        Route::post('create', [LeaveController::class, 'store']);
        Route::post('update', [LeaveController::class, 'update']);
        Route::post('delete', [LeaveController::class, 'delete']);
    });

    // asset
    Route::group(['prefix' => 'asset'], function () {
        Route::post('list', [AssetController::class, 'index']);
        Route::post('create', [AssetController::class, 'store']);
        Route::post('update', [AssetController::class, 'update']);
        Route::post('delete', [AssetController::class, 'delete']);
    });

    // document
    Route::group(['prefix' => 'document'], function () {
        Route::post('list', [DocumentController::class, 'index']);
        Route::post('create', [DocumentController::class, 'store']);
        Route::post('update', [DocumentController::class, 'update']);
        Route::post('delete', [DocumentController::class, 'delete']);
    });


    //role
    Route::group(['prefix' => 'role'], function () {
        Route::post('list', [RoleController::class, 'index']);
        Route::post('create', [RoleController::class, 'store']);
        Route::post('update', [RoleController::class, 'update']);
        Route::post('assign', [RoleController::class, 'assignPermission']);
        Route::post('delete', [RoleController::class, 'delete']);
    });

    //Permission
    Route::group(['prefix' => 'permission'], function () {
        Route::post('list', [PermissionController::class, 'index']);
        // Route::post('create', [PermissionController::class, 'store']);
        Route::post('update', [PermissionController::class, 'update']);
        // Route::post('assign', [PermissionController::class, 'assignPermission']);
        // Route::post('delete', [PermissionController::class, 'delete']);
    });

    // Designation
    Route::group(['prefix' => 'designation'], function () {
        Route::post('list', [DesignationController::class, 'index']);
        Route::post('create', [DesignationController::class, 'store']);
        Route::post('update', [DesignationController::class, 'update']);
        Route::post('delete', [DesignationController::class, 'delete']);
    });

    //Attendance
    Route::group(['prefix' => 'health'], function () {
        Route::post('list', [AttendanceController::class, 'index']);
        Route::post('create', [AttendanceController::class, 'store']);
        Route::post('update', [AttendanceController::class, 'update']);
        Route::post('delete', [AttendanceController::class, 'delete']);
        Route::post('show', [AttendanceController::class, 'show']);
        Route::post('attendance', [AttendanceController::class, 'markAttendance']);
        Route::post('logout', [AttendanceController::class, 'markLogout']);
        // Route::post('login', [AttendanceController::class, 'viewAttendance']);
    });


    //expensesType
    Route::group(['prefix' => 'expenses-type'], function () {
        Route::post('list', [ExpensesTypeController::class, 'index']);
        Route::post('create', [ExpensesTypeController::class, 'store']);
        Route::post('update', [ExpensesTypeController::class, 'update']);
        Route::post('delete', [ExpensesTypeController::class, 'delete']);
    });


    //expenses
    Route::group(['prefix' => 'expenses'], function () {
        Route::post('list', [ExpensesController::class, 'index']);
        Route::post('create', [ExpensesController::class, 'store']);
        Route::post('update', [ExpensesController::class, 'update']);
        Route::post('delete', [ExpensesController::class, 'delete']);
    });

    //expensesDetails
    Route::group(['prefix' => 'expenses-detail'], function () {
        Route::post('list', [ExpensesDetailController::class, 'index']);
        Route::post('create', [ExpensesDetailController::class, 'store']);
        Route::post('update', [ExpensesDetailController::class, 'update']);
        Route::post('delete', [ExpensesDetailController::class, 'delete']);
    });


    //Bank details
    Route::group(['prefix' => 'bank-details'], function () {
        Route::post('list', [BankDetailsController::class, 'index']);
        Route::post('create', [BankDetailsController::class, 'store']);
        Route::post('update', [BankDetailsController::class, 'update']);
        Route::post('delete', [BankDetailsController::class, 'delete']);
        Route::post('show', [BankDetailsController::class, 'show']);
    });

    // payout
    Route::group(['prefix' => 'payouts'], function () {
        Route::post('list', [PayoutController::class, 'index']);
        Route::post('create', [PayoutController::class, 'store']);
        Route::post('update', [PayoutController::class, 'update']);
        Route::post('delete', [PayoutController::class, 'delete']);
    });
    // payslip
    Route::group(['prefix' => 'payslip'], function () {
        Route::post('list', [PayslipController::class, 'index']);
        Route::post('create', [PayslipController::class, 'store']);
        Route::post('update', [PayslipController::class, 'update']);
        Route::post('delete', [PayslipController::class, 'delete']);
    });

    // ticketType
    Route::group(['prefix' => 'ticket-type'], function () {
        Route::post('list', [TicketTypeController::class, 'index']);
        Route::post('create', [TicketTypeController::class, 'store']);
        Route::post('update', [TicketTypeController::class, 'update']);
        Route::post('delete', [TicketTypeController::class, 'delete']);
    });

    // ticket
    Route::group(['prefix' => 'ticket'], function () {
        Route::post('list', [TicketController::class, 'index']);
        Route::post('create', [TicketController::class, 'store']);
        Route::post('update', [TicketController::class, 'update']);
        Route::post('delete', [TicketController::class, 'delete']);
    });

    // User Document
    Route::group(['prefix' => 'user-document'], function () {
        Route::post('list', [UserDocumentController::class, 'index']);
        Route::post('create', [UserDocumentController::class, 'store']);
        Route::post('update', [UserDocumentController::class, 'update']);
        Route::post('delete', [UserDocumentController::class, 'delete']);
        Route::post('show', [UserDocumentController::class, 'show']);
    });

    // User asset
    Route::group(['prefix' => 'user-asset'], function () {
        Route::post('list', [UserAssetsController::class, 'index']);
        Route::post('create', [UserAssetsController::class, 'store']);
        Route::post('update', [UserAssetsController::class, 'update']);
        Route::post('delete', [UserAssetsController::class, 'delete']);
        Route::post('show', [UserAssetsController::class, 'show']);
    });

    // user leave
    Route::group(['prefix' => 'user-leave'], function () {
        Route::post('list', [UserLeaveController::class, 'index']);
        Route::post('create', [UserLeaveController::class, 'store']);
        Route::post('update', [UserLeaveController::class, 'update']);
        Route::post('delete', [UserLeaveController::class, 'delete']);
        Route::post('show', [UserLeaveController::class, 'show']);
    });


    // Experience
    Route::group(['prefix' => 'user-experience'], function () {
        Route::post('list', [ExperienceController::class, 'index']);
        Route::post('create', [ExperienceController::class, 'store']);
        Route::post('update', [ExperienceController::class, 'update']);
        Route::post('delete', [ExperienceController::class, 'delete']);
        Route::post('show', [ExperienceController::class, 'show']);
    });

    // education details
    Route::group(['prefix' => 'education-details'], function () {
        Route::post('list', [EducationDetailsController::class, 'index']);
        Route::post('create', [EducationDetailsController::class, 'store']);
        Route::post('update', [EducationDetailsController::class, 'update']);
        Route::get('delete', [EducationDetailsController::class, 'destroy']);
        Route::post('show', [EducationDetailsController::class, 'show']);
    });

     // TypeRate
     Route::group(['prefix' => 'type-rate'], function () {
        Route::post('list', [TypeRateController::class, 'index']);
        Route::post('create', [TypeRateController::class, 'store']);
        Route::post('update', [TypeRateController::class, 'update']);
        Route::post('delete', [TypeRateController::class, 'delete']);
    });
// type valuation
    Route::group(['prefix' => 'type-valuation'], function () {
        Route::post('list', [TypeValuationsController::class, 'index']);
        Route::post('create', [TypeValuationsController::class, 'store']);
        Route::post('update', [TypeValuationsController::class, 'update']);
        Route::post('delete', [TypeValuationsController::class, 'delete']);
    });
});

  
    // Route::post('create1', [EmployeeController::class, 'show']);
   
