<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\SubBusinessUnitController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\JobFunctionController;
use App\Http\Controllers\SubFunctionController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RecruitmentStageController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\DynamicRoleController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Role-based Dashboards
    Route::get('/admin/dashboard', [DashboardController::class , 'admin'])->name('admin.dashboard');
    Route::get('/hr/dashboard', [DashboardController::class , 'hr'])->name('hr.dashboard');
    Route::get('/manager/dashboard', [DashboardController::class , 'manager'])->name('manager.dashboard');
    Route::get('/dashboard', [DashboardController::class , 'employee'])->name('dashboard');

    // HR Modules
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('banks', BankController::class);
    Route::post('banks/import', [BankController::class , 'import'])->name('banks.import');

    Route::resource('business-units', BusinessUnitController::class);
    Route::post('business-units/import', [BusinessUnitController::class , 'import'])->name('business-units.import');

    Route::resource('sub-business-units', SubBusinessUnitController::class);
    Route::post('sub-business-units/import', [SubBusinessUnitController::class , 'import'])->name('sub-business-units.import');

    // Company Route
    Route::resource('companies', CompanyController::class);

    Route::resource('designations', DesignationController::class);
    Route::post('designations/import', [DesignationController::class, 'import'])->name('designations.import');

    Route::post('employee-types/import', [EmployeeTypeController::class, 'import'])->name('employee-types.import');
    Route::get('employee-types/download-template', [EmployeeTypeController::class, 'downloadTemplate'])->name('employee-types.download-template');
    Route::resource('employee-types', EmployeeTypeController::class);

    Route::post('job-functions/import', [JobFunctionController::class, 'import'])->name('job-functions.import');
    Route::get('job-functions/download-template', [JobFunctionController::class, 'downloadTemplate'])->name('job-functions.download-template');
    Route::resource('job-functions', JobFunctionController::class);

    Route::post('sub-functions/import', [SubFunctionController::class, 'import'])->name('sub-functions.import');
    Route::get('sub-functions/download-template', [SubFunctionController::class, 'downloadTemplate'])->name('sub-functions.download-template');
    Route::resource('sub-functions', SubFunctionController::class);

    Route::post('holidays/import', [HolidayController::class, 'import'])->name('holidays.import');
    Route::get('holidays/download-template', [HolidayController::class, 'downloadTemplate'])->name('holidays.download-template');
    Route::resource('holidays', HolidayController::class);

    Route::post('qualifications/import', [QualificationController::class, 'import'])->name('qualifications.import');
    Route::get('qualifications/download-template', [QualificationController::class, 'downloadTemplate'])->name('qualifications.download-template');
    Route::resource('qualifications', QualificationController::class);

    // Location, State, City
    Route::post('locations/import', [LocationController::class, 'import'])->name('locations.import');
    Route::get('locations/get-states', [LocationController::class, 'getStates'])->name('locations.get-states');
    Route::get('locations/get-cities', [LocationController::class, 'getCities'])->name('locations.get-cities');
    Route::resource('locations', LocationController::class);

    Route::post('states/import', [StateController::class, 'import'])->name('states.import');
    Route::resource('states', StateController::class);

    Route::post('cities/import', [CityController::class, 'import'])->name('cities.import');
    Route::get('cities/get-states/{country_id}', [CityController::class, 'getStatesByCountry'])->name('cities.get-states');
    Route::resource('cities', CityController::class);

    Route::resource('recruitment-stages', RecruitmentStageController::class);
    Route::get('universities/download-template', [UniversityController::class, 'downloadTemplate'])->name('universities.download-template');
    Route::post('universities/import', [UniversityController::class, 'import'])->name('universities.import');
    Route::resource('universities', UniversityController::class);
    Route::resource('years', YearController::class);
    Route::post('dynamic-roles/import', [DynamicRoleController::class, 'import'])->name('dynamic-roles.import');
    Route::resource('dynamic-roles', DynamicRoleController::class);

    // Attendance
    Route::get('/attendance', [AttendanceController::class , 'index'])->name('attendance.index');
    Route::post('/attendance/clock-in', [AttendanceController::class , 'clockIn'])->name('attendance.clock-in');
    Route::post('/attendance/clock-out', [AttendanceController::class , 'clockOut'])->name('attendance.clock-out');

    // Leave Management
    Route::get('/leaves', [LeaveController::class , 'index'])->name('leaves.index');
    Route::get('/leaves/create', [LeaveController::class , 'create'])->name('leaves.create');
    Route::post('/leaves', [LeaveController::class , 'store'])->name('leaves.store');
    Route::post('/leaves/{leave}/approve', [LeaveController::class , 'approve'])->name('leaves.approve');

    // Payroll
    Route::get('/payroll', [PayrollController::class , 'index'])->name('payroll.index');
    Route::post('/payroll', [PayrollController::class , 'store'])->name('payroll.store');
    Route::get('/payroll/{payroll}/download', [PayrollController::class , 'downloadPayslip'])->name('payroll.download');

    // Announcements
    Route::get('/announcements', [AnnouncementController::class , 'index'])->name('announcements.index');
    Route::post('/announcements', [AnnouncementController::class , 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class , 'destroy'])->name('announcements.destroy');

    // Super Admin & Admin: User & Settings
    Route::middleware(['role:Super Admin|Admin'])->group(function () {
            Route::resource('roles', RoleController::class);

            Route::get('/users', [UserController::class , 'index'])->name('users.index');
            Route::get('/users/{user}/edit', [UserController::class , 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class , 'update'])->name('users.update');

            Route::get('/settings', [SettingController::class , 'index'])->name('settings.index');
            Route::post('/settings', [SettingController::class , 'update'])->name('settings.update');
        }
        );

        // Profile Routes
        Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');    });

require __DIR__ . '/auth.php';
