<?php

namespace App\Http\Controllers\Backend;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompany;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('read-company')) {
            abort(403);
        }

        if ($request->ajax()) {
            $companies = Company::query();

            if ($request->has('keyword')) {
                $keyword = $request->keyword;
                $companies->orderBy('updated_at', 'desc')
                ->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('my_title', 'like', '%' . $keyword . '%');
            }

            $companies = $companies->paginate($request->limits ?? 10);

            return response()->json([
                'success' => true,
                'showItemInfo' => view('backend.components.show_data_info', [ 'items' => $companies])->render(),
                'tableRowData' => view('backend.company.table', compact('companies'))->render(),
                'pagination' => $companies->links()->render(),
                'totalCount' => $companies->count()
            ]);
        }
        return view('backend.company.index');
    }

    public function create()
    {
        if (!auth()->user()->can('create-company')) {
            abort(403, 'You don\'t have permission to create new one.');
        }

        return view('backend.company.form')->render();
    }

    public function store(StoreCompany $request)
    {
        if (!auth()->user()->can('create-company')) {
            abort(403, 'You don\'t have permission to create new one.');
        }

        Company::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'address'       => $request->address,
        ]);

        return redirect()->back()->with('success', 'Company was successfully created!');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('update-company')) {
            abort(403, 'You don\'t have permission to edit.');
        }

        $old_data = company::findOrFail($id);
        return view('backend.company.form', compact('old_data'))->render();
    }

    public function update(UpdateCompany $request, $id)
    {
        if (!auth()->user()->can('update-company')) {
            abort(403, 'You don\'t have permission to edit.');
        }

        $company = Company::findOrFail($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->update();

        return redirect()->back()->with('success', 'Company was successfully updated!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete-company')) {
            abort(403, 'You don\'t have permission to delete.');
        }

        try {
            Company::findOrFail($id)->delete();
            $res = [
                'status' => 'success',
                'message' => 'Company was successfully deleted.'
            ];
        } catch (\Exception $e) {
            $res = [
                'status' => 'fail',
                'message' => $e.getMessage()
            ];
        }
        
        return response()->json($res);
    }

    public function getAvailablecompany(Request $request)
    {
        return company::orderBy('name')->where('available', $request->available)->get();
    }
}
