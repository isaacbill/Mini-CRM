<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $showUrl = route('companies.show', $row->id); // Generate show URL
                    $editUrl = route('companies.edit', $row->id); // Generate edit URL
                    $deleteUrl = route('companies.destroy', $row->id); // Generate delete URL
                    $btn = '<a href="'.$showUrl.'" class="show btn btn-info btn-sm">Show</a>';
                    $btn .= ' <a href="'.$editUrl.'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-url="'.$deleteUrl.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                'regex:/@co\.ke$|@go\.ke$/', // Correctly delimited regex for email validation
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => [
                'nullable',
                'url',
                'regex:/^https:\/\/www\./', // Correctly delimited regex for website URL validation
            ],
        ]);
    
        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
    
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            $company->logo = basename($logoPath);
        }
    
        $company->website = $request->input('website');
        $company->save();
    
        return redirect()->route('companies.index')->with('success', 'Company added successfully.');
    }
    
    // Show the edit form for a specific company
public function edit($id)
{
    $company = Company::findOrFail($id); // Find the company by ID

    // Return the edit view with the company data
    return view('companies.edit', compact('company'));
}

// Handle the form submission and update the company data
public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'website' => 'nullable|url|max:255',
    ]);

    // Find the company by ID
    $company = Company::findOrFail($id);

    // Update the company's data
    $company->name = $request->input('name');
    $company->email = $request->input('email');
    $company->website = $request->input('website');
    $company->save(); // Save the changes to the database

    // Redirect back to the index page with a success message
    return redirect()->route('companies.index')->with('success', 'Company updated successfully');
}

public function show($id)
{
    $company = Company::findOrFail($id); // Find the company by ID
    return view('companies.show', compact('company')); // Pass company data to the view
}
// Delete a specific company
public function destroy($id)
{
    try {
        $company = Company::findOrFail($id); // Find the company by ID
        $company->delete(); // Delete the company
        return response()->json(['success' => 'Company deleted successfully']); // Return a success response
    } catch (\Exception $e) {
        // Handle the error and return a response with the error message
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}

}