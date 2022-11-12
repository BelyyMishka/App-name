<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.admin.index', [
            'title' => 'Admins',
        ]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admin::all();
            return DataTables::of($admins)->addColumn('action', function ($row) {
                $actionButtons = view('admin.sections.action_buttons', [
                    'route' => 'admin.admins',
                    'item' => $row,
                ])->render();
                return $actionButtons;
            })->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.admin.create', [
            'title' => 'Create admin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        Admin::add($data);

        return redirect()->route('admin.admins.index')->with('success', 'Admin was added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admin.edit', [
            'title' => 'Edit admin',
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($id),
            ],
            'password' => [
                'nullable',
                'min:6',
                'confirmed',
            ],
            'password_confirmation' => [
                'nullable',
                'same:password',
            ]
        ]);

        $admin = Admin::findOrFail($id);
        $data = $request->all();
        Admin::edit($data, $admin);

        return redirect()->route('admin.admins.index')->with('success', 'Admin was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Admin::destroy($id);

        return redirect()->route('admin.admins.index')->with('success', 'Admin was deleted.');
    }
}
