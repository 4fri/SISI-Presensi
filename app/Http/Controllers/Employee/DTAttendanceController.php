<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DTEmployee;
use App\Models\DTAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class DTAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function attendance()
    {
        $auth = Auth::user();

        $user = User::with(['employee', 'employee.position'])
            ->where('id', $auth->id)
            ->first();

        $currentDate = Carbon::now();

        $year = $currentDate->year;
        $month = $currentDate->month;

        // Menghitung tanggal awal dan akhir bulan
        $startOfMonth = Carbon::create($year, $month, 1, 0, 0, 0);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Query untuk mendapatkan data kehadiran dalam rentang waktu tersebut
        $attendances = DTAttendance::where('employee_id', $user->employee->id)
            ->where('status', 'Hadir')
            ->whereBetween('check_in', [$startOfMonth, $endOfMonth])->get();

        return view('employee.attendance.attendance', compact('user', 'attendances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function checkIn()
    {

        $auth = Auth::user();

        $employee = DTEmployee::with('checkInToday')
            ->where('user_id', $auth->id)->first();

        $currentTime = Carbon::now();
        $start_time = Carbon::createFromTime(7, 0, 0); // Pukul 07.00
        $end_time = Carbon::createFromTime(8, 30, 0); // Pukul 08.30

        $check_in = new DTAttendance();
        $check_in->employee_id = $employee->id;
        $check_in->check_in = now();

        // anda dapat check in diantara pukul 07.00 sampai dengan 08.30 setiap hari
        if (!isset($employee->checkInToday)) {
            if ($currentTime->between($start_time, $end_time)) {
                $status = 'Hadir';
                $note = $auth->name . ' Has been checked in ' . now();

                $check_in->status = $status;
                $check_in->note = $note;
                $check_in->save();

                Toastr::error($note, $status);
                return redirect()->back();
            } else {
                $status = 'Tidak Hadir';
                $note = $auth->name . ' Late checking in ' . now();

                $check_in->status = $status;
                $check_in->note = $note;
                $check_in->save();

                Toastr::error($note, $status);
                return redirect()->back();
            }
        } else {
            Toastr::warning('You have checked in ' . $employee->checkInToday->note, $employee->checkInToday->status);
            return redirect()->back();
        }
    }
}
