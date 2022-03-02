<?php

namespace App\Http\Controllers\Backend;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreDepartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDepartment;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('read-department')) {
            abort(403);
        }

        if ($request->ajax()) {
            $departments = Department::query();

            if ($request->has('keyword')) {
                $keyword = $request->keyword;
                $departments->orderBy('updated_at', 'desc')
                ->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('my_title', 'like', '%' . $keyword . '%');
            }

            $data = $departments->paginate($request->limits ?? 10);

            return response()->json([
                'success' => true,
                'showItemInfo' => view('backend.components.show_data_info', [ 'items' => $data])->render(),
                'tableRowData' => view('backend.department.table', compact('data'))->render(),
                'pagination' => $data->links()->render(),
                'totalCount' => $data->count()
            ]);
        }
        return view('backend.department.index');
    }

    public function create()
    {
        if (!auth()->user()->can('create-department')) {
            abort(403, 'You don\'t have permission to create new one.');
        }

        return view('backend.department.form')->render();
    }

    public function store(StoreDepartment $request)
    {
        if (!auth()->user()->can('create-department')) {
            abort(403, 'You don\'t have permission to create new one.');
        }

        Department::create([
            'name'          => $request->name,
        ]);

        return redirect()->back()->with('success', 'Department was successfully created!');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('update-department')) {
            abort(403, 'You don\'t have permission to edit.');
        }

        $old_data = Department::findOrFail($id);
        return view('backend.department.form', compact('old_data'))->render();
    }

    public function update(UpdateDepartment $request, $id)
    {
        if (!auth()->user()->can('update-department')) {
            abort(403, 'You don\'t have permission to edit.');
        }

        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->update();

        return redirect()->back()->with('success', 'Department was successfully updated!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete-department')) {
            abort(403, 'You don\'t have permission to delete.');
        }

        try {
            Department::findOrFail($id)->delete();
            $res = [
                'status' => 'success',
                'message' => 'Department was successfully deleted.'
            ];
        } catch (\Exception $e) {
            $res = [
                'status' => 'fail',
                'message' => $e.getMessage()
            ];
        }
        
        return response()->json($res);
    }

    public function getAvailableDepartment(Request $request)
    {
        return Department::orderBy('name')->where('available', $request->available)->get();
    }
}
