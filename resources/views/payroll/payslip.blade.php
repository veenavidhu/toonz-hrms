<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payslip - {{ $payroll->month }} {{ $payroll->year }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #edeff2;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 5px;
        }

        .payslip-title {
            font-size: 18px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .info-section td {
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .label {
            font-weight: bold;
            color: #6b7280;
            font-size: 12px;
            width: 30%;
        }

        .value {
            color: #111827;
            font-size: 14px;
        }

        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #e5e7eb;
        }

        .salary-table th {
            background-color: #f9fafb;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }

        .salary-table td {
            padding: 12px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .summary {
            width: 40%;
            margin-left: auto;
            margin-top: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .net-salary {
            background-color: #f3f4f6;
            padding: 15px;
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            margin-top: 10px;
            border-radius: 8px;
        }

        .net-salary .total-label {
            font-size: 12px;
            display: block;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-name">HRMS Solution Ltd</div>
        <div class="payslip-title">Official Salary Slip</div>
        <div style="font-size: 12px; color: #6b7280;">Month: {{ $payroll->month }} {{ $payroll->year }}</div>
    </div>

    <table class="info-section">
        <tr>
            <td class="label">Employee Name:</td>
            <td class="value">{{ $payroll->user->name }}</td>
            <td class="label">Employee ID:</td>
            <td class="value">{{ $payroll->user->employee->employee_id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Designation:</td>
            <td class="value">{{ $payroll->user->employee->designation ?? 'N/A' }}</td>
            <td class="label">Department:</td>
            <td class="value">{{ $payroll->user->employee->department->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Generated on:</td>
            <td class="value">{{ \Carbon\Carbon::now()->format('d M, Y') }}</td>
            <td class="label">Status:</td>
            <td class="value" style="color: #059669; font-weight: bold;">PAID</td>
        </tr>
    </table>

    <table class="salary-table">
        <thead>
            <tr>
                <th>Description</th>
                <th style="text-align: right;">Earnings</th>
                <th style="text-align: right;">Deductions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Basic Salary</td>
                <td style="text-align: right;">${{ number_format($payroll->base_salary, 2) }}</td>
                <td style="text-align: right;">$0.00</td>
            </tr>
            <tr>
                <td>Performance Bonus</td>
                <td style="text-align: right;">${{ number_format($payroll->bonuses, 2) }}</td>
                <td style="text-align: right;">$0.00</td>
            </tr>
            <tr>
                <td>General Deductions</td>
                <td style="text-align: right;">$0.00</td>
                <td style="text-align: right;">${{ number_format($payroll->deductions, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="summary">
        <div class="net-salary">
            <span class="total-label">NET PAYABLE AMOUNT</span>
            ${{ number_format($payroll->net_salary, 2) }}
        </div>
    </div>

    <div class="footer">
        This is a system-generated payslip and does not require a physical signature.
    </div>
</body>

</html>
