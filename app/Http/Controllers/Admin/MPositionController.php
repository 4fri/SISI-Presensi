<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MPosition;
use Illuminate\Http\Request;

class MPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = MPosition::paginate(10);

        return view('admin.position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'salary' => ['required'],
        ]);

        try {
            MPosition::create($request->all());

            return redirect()->route('index_position');
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
        $position = MPosition::findOrfail($id);

        return view('admin.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'salary' => ['required'],
        ]);

        try {
            MPosition::where('id', $id)->update([
                'name' => $request->name,
                'salary' => $request->salary,
                'salary_note' => $request->salary_note,
            ]);

            return redirect()->route('index_position');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $position = MPosition::findOrFail($id);
            $position->delete();

            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
