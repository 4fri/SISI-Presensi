<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DTEmployee;
use App\Models\DTTravelPermit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $search = $req->search;

        $travelPermits = DTTravelPermit::with(['employee', 'employee.user', 'employee.position'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('id_card', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($qq) use ($search) {
                            $qq->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->paginate(10);


        $user = Auth::user();

        if ($user->hasRole('employee')) {
            $prop_status = 'disabled';
        } else {
            $prop_status = '';
        }

        return view('admin.travel-permit.index', compact('travelPermits', 'prop_status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travel-permit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'date_off' => ['required'],
            'description' => ['required']
        ]);

        $user = Auth::user();

        $employee = DTEmployee::where('user_id', $user->id)->first();

        try {
            DTTravelPermit::create([
                'employee_id' => $employee->id,
                'date_off' => $request->date_off,
                'description' => $request->description,
                'created_by' => $user->id
            ]);

            Toastr::success('You have successfully requested Travel Permit on ' . date('d M Y', strtotime($request->date_off)), 'Success');

            return redirect()->route('index_travel_permit');
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

        $travelPermit = DTTravelPermit::with('employee')
            ->find($id);

        try {
            $travelPermit->status = $request->status;
            $travelPermit->updated_by = Auth::user()->id;
            $travelPermit->update();

            if ($request->status === '1') {
                $travelPermit->employee->status = 2;
            } else {
                $travelPermit->employee->status = 1;
            }

            $travelPermit->employee->updated_by = Auth::user()->id;
            $travelPermit->employee->update();

            Toastr::success('You have successfully approved Travel Permit on ' . date('d M Y', strtotime($travelPermit->date_off)), 'Success');
            return back();
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
