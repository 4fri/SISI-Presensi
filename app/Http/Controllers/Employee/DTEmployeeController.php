<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use App\Models\MPosition;
use App\Models\DTEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DTEmployeeController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $auth = Auth::user();

        $user = User::with(['employee', 'employee.position'])
            ->findOrFail($auth->id);

        if ($user->employee->status === 1) {
            $status_employee = 'Active';
        } elseif ($user->employee->status === 2) {
            $status_employee = 'Travel Permit';
        } else {
            $status_employee = 'Not Active/Furlough';
        }

        $data = [
            'user' => $user,
            'status_employee' => $status_employee
        ];

        return view('employee.profile.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $auth = Auth::user();

        $positions = MPosition::get();

        $user = User::with(['employee', 'employee.position'])
            ->findOrFail($auth->id);

        $data = [
            'positions' => $positions,
            'user' => $user,
        ];

        return view('employee.profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            // 'position_id' => ['required'],
            'id_card' => ['required', 'min:16', 'max:16'],
            'phone_number' => ['required'],
            'photo' => ['nullable', 'max:1028', 'mimes:png,jpg,jpeg'],
        ]);

        $auth = Auth::user();


        try {
            $user = User::findOrFail($auth->id);
            $path = 'photo-profiles/' . $user->id;

            if ($request->file('photo') !== null) {
                if ($user->photo !== null) {
                    $delete_storage = Storage::disk('public')->delete($user->photo);
                }

                $user->photo = $request->file('photo')->store($path, 'public');
            }

            $user->update();

            $employee = DTEmployee::updateOrCreate(
                [
                    'user_id' => $user->id
                ],
                [
                    // 'position_id' => $request->position_id,
                    'id_card' => $request->id_card,
                    'phone_number' => $request->phone_number,
                    'updated_by' => $user->id,
                ]
            );

            return redirect()->route('profile_employee');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
