<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('company')->get(); // Eager load the company
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $showUrl = route('employees.show', $row->id);
                    $editUrl = route('employees.edit', $row->id);
                    $deleteUrl = route('employees.destroy', $row->id);
                    $btn = '<a href="'.$showUrl.'" class="show btn btn-info btn-sm">Show</a>';
                    $btn .= ' <a href="'.$editUrl.'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-url="'.$deleteUrl.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employees.index');
    }

    public function create()
    {
        $companies = Company::all(); // Get all companies for the dropdown
        return view('employees.create', compact('companies'));
    }
    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company_id' => 'required|exists:companies,id',
        'email' => [
            'nullable',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@(go\.ke|co\.ke|gmail\.com)$/'
        ],
        'phone' => [
            'nullable',
            'regex:/^\d+$/'
        ],
    ]);

    Employee::create($request->all());

    return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company_id' => 'required|exists:companies,id',
        'email' => [
            'nullable',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@(go\.ke|co\.ke|gmail\.com)$/'
        ],
        'phone' => [
            'nullable',
            'regex:/^\d+$/'
        ],
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update($request->all());

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}
public function show($id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }


    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json(['success' => 'Employee deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
