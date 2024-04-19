<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\DTPayroll;
use App\Models\DTEmployee;
use App\Models\DTAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DTEmployee::with(['position', 'user'])->get();

        //dwdwdw
        return view('admin.attendance.index', compact('employees'));
    }

    public function showDetail($id)
    {
        $employee = DTEmployee::with(['position', 'user'])
            ->findOrFail($id);

        $attendance = DTAttendance::where('employee_id', $id)
            ->get();

        $data = [
            'employee' => $employee,
            'attendance' => $attendance
        ];

        return view('admin.attendance.detail', $data);
    }

    public function payrollAttendance($id)
    {
        $employee = DTEmployee::with(['position', 'user', 'attendance'])
            ->findOrFail($id);

        $attendanceHadir = DTAttendance::where('employee_id', $id)
            ->where('status', 'Hadir')
            ->get();

        $attendanceTidakHadir = DTAttendance::where('employee_id', $id)
            ->where('status', 'Tidak Hadir')
            ->get();

        $currentMonthName = Carbon::now()->monthName;

        $data = [
            'employee' => $employee,
            'attendanceHadir' => count($attendanceHadir),
            'attendanceTidakHadir' => count($attendanceTidakHadir),
            'attendancePayCut' => count($attendanceTidakHadir) * $employee->position->salary,
            'totalPay' => count($attendanceHadir) * $employee->position->salary,
            'currentMonthName' => $currentMonthName
        ];

        return view('admin.attendance.payroll', $data);
    }

    public function storePayrollAttendance(Request $req, $id)
    {
        $req->validate([
            'status_payment' => ['required']
        ]);

        $employee = DTEmployee::with(['position', 'user', 'attendance', 'payroll'])
            ->findOrFail($id);

        $attendanceHadir = DTAttendance::where('employee_id', $id)
            ->where('status', 'Hadir')
            ->get();

        $attendanceTidakHadir = DTAttendance::where('employee_id', $id)
            ->where('status', 'Tidak Hadir')
            ->get();

        // Check if payroll for the current month exists
        $currentMonthPayroll = DTPayroll::where('employee_id', $employee->id)
            ->whereMonth('paid_at', Carbon::now()->month)
            ->whereYear('paid_at', Carbon::now()->year)
            ->first();

        if ($currentMonthPayroll) {
            // Payroll for the current month already exists, show a message and return back
            Toastr::warning('Payroll for this month has already been paid.', 'Warning');
            return back();
        }

        try {
            if (!isset($employee->payroll)) {
                if ($req->status_payment === 'Not yet paid') {
                    $status_payment = 'Not yet paid';
                    $paid_at = null;
                } else {
                    $status_payment = 'Already paid';
                    $paid_at = now();
                }

                DTPayroll::create([
                    'employee_id' => $employee->id,
                    'total_attendance' => count($attendanceHadir),
                    'total_not_present' => count($attendanceTidakHadir),
                    'basic_salary' => $employee->position->salary,
                    'cutting' => count($attendanceTidakHadir) * $employee->position->salary,
                    'total_salary' => count($attendanceHadir) * $employee->position->salary,
                    'status' => $status_payment,
                    'paid_at' => $paid_at,
                    'created_by' => auth()->user()->id
                ]);

                Toastr::success('Data Payroll created successfully', 'Success');
                return back();
            } else {
                if ($employee->payroll->status === 'Not yet paid') {
                    $employee->payroll->update([
                        'status' => $req->status_payment,
                        'paid_at' => now(),
                        'updated_by' => auth()->user()->id
                    ]);

                    Toastr::success('Status Payment Updated successfully', 'Success');
                    return back();
                } else {
                    Toastr::warning('Status Payment Already Updated', 'Warning');
                    return back();
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
