<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo view('employee-types.index', [
        'employeeTypes' => App\Models\EmployeeType::paginate(),
        'search' => ''
    ])->render();
    echo "NO_ERROR\n";
} catch (Throwable $e) {
    echo 'BLADE_ERROR: ' . $e->getMessage() . "\n";
}
