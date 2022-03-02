<?php

namespace App\Http\Controllers\Backend;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateEmployee;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('read-employee')) {
            abort(403);
        }

        if ($request->ajax()) {
            $companies = Employee::query();

            if ($request->has('keyword')) {
                $keyword = $request->keyword;
                $companies->orderBy('updated_at', 'desc')
                ->where('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%')
                ->orWhereHas('company', function($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            }

            $data = $companies->paginate($request->limits ?? 10);

            return response()->json([
                'success' => true,
                'showItemInfo' => view('backend.components.show_data_info', [ 'items' => $data])->render(),
                'tableRowData' => view('backend.employee.table', compact('data'))->render(),
                'pagination' => $data->links()->render(),
                'totalCount' => $data->count()
            ]);
        }
        return view('backend.employee.index');
    }

    public function create()
    {
        if (!auth()->user()->can('create-employee')) {
            abort(403, 'You don\'t have permission to create new one.');
        }
        $companies = Company::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

        return view('backend.employee.form', compact('companies', 'departments'))->render();
    }

    public function store(StoreEmployee $request)
    {
        if (!auth()->user()->can('create-employee')) {
            abort(403, 'You don\'t have permission to create new one.');
        }

        $employee = Employee::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'staff_id'      => $request->staff_id,
            'address'       => $request->address,
            'password'      => Hash::make($request->password),
            'company_id'    => $request->company_id,
            'department_id' => $request->department_id
        ]);

        $role = Role::findOrFail(2);

        $employee->assignRole($role->name);

        return redirect()->back()->with('success', 'Employee was successfully created!');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('update-employee')) {
            abort(403, 'You don\'t have permission to edit.');
        }

        $old_data = Employee::findOrFail($id);
        $companies = Company::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('backend.employee.form', compact('old_data', 'companies', 'departments'))->render();
    }

    public function update(UpdateEmployee $request, $id)
    {
        if (!auth()->user()->can('update-employee')) {
            abort(403, 'You don\'t have permission to edit.');
        }
        $employee = Employee::findOrFail($id);
        $password = $employee->password;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->staff_id = $request->staff_id;
        $employee->address = $request->address;
        $employee->password = $request->password ? Hash::make($request->password) : $password;
        $employee->update();

        return redirect()->back()->with('success', 'Employee was successfully updated!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete-employee')) {
            abort(403, 'You don\'t have permission to delete.');
        }

        try {
            Employee::findOrFail($id)->delete();
            $res = [
                'status' => 'success',
                'message' => 'Employee was successfully deleted.'
            ];
        } catch (\Exception $e) {
            $res = [
                'status' => 'fail',
                'message' => $e.getMessage()
            ];
        }
        
        return response()->json($res);
    }

    public function getAvailableEmployee(Request $request)
    {
        return Employee::orderBy('name')->where('available', $request->available)->get();
    }
}
