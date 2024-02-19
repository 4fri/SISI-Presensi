<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\MPosition;
use App\Models\DTEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DTEmployee::with(['position', 'user'])->paginate(10);

        return view('admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = MPosition::get();

        return view('admin.employee.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'position_id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'id_card' => ['required', 'min:16', 'max:16'],
            'phone_number' => ['required'],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('employee');

            $employee = DTEmployee::create([
                'user_id' => $user->id,
                'position_id' => $request->position_id,
                'id_card' => $request->id_card,
                'phone_number' => $request->phone_number,
                'created_by' => Auth::user()->id
            ]);

            Toastr::success('Employee have been added', 'Success!');
            return redirect()->route('index_employees');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
