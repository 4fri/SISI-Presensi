<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class UserRole extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);

        return view('admin.user-role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            Role::create($request->all());

            return redirect()->route('index_user_role');
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
        $role = Role::findOrFail($id);

        return view('admin.user-role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            Role::where('id', $id)->update([
                'name' => $request->name
            ]);

            return redirect()->route('index_user_role');
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
            $role = Role::findOrFail($id);
            $role->delete();

            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
