<?php

namespace App\Http\Controllers;

use App\approver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApproverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TEMP FIX: normalize dept ordering
        $app = approver::orderByRaw('LOWER(TRIM(dept))')->paginate(10);
        return view('approver.list')->with('app', $app);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('approver.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hName'     => 'required|string|max:100',
            'hEmail'    => 'required|email|max:100|unique:approvers,email',
            'hDept'     => 'required|string|max:50',
            'company'   => 'required|string|max:50',
            'location'  => 'nullable|string|max:50'
        ]);

        $app = new approver;
        $app->name     = trim($validated['hName']);
        $app->email    = strtolower(trim($validated['hEmail']));
        $app->dept     = strtoupper(trim($validated['hDept']));
        $app->company  = strtoupper(trim($validated['company']));
        $app->location = $validated['location']
                            ? strtoupper(trim($validated['location']))
                            : null;

        $app->save();

        return redirect('approver')->with('status', 'Approver saved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req)
    {
        $app = approver::findOrFail($req->id);
        return view('approver.edit')->with('app', $app);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'hName'     => 'required|string|max:100',
            'hEmail'    => 'required|email|max:100|unique:approvers,email,' . $request->id,
            'hDept'     => 'required|string|max:50',
            'company'   => 'required|string|max:50',
            'location'  => 'nullable|string|max:50'
        ]);

        $app = approver::findOrFail($request->id);

        $app->name     = trim($validated['hName']);
        $app->email    = strtolower(trim($validated['hEmail']));
        $app->dept     = strtoupper(trim($validated['hDept']));
        $app->company  = strtoupper(trim($validated['company']));
        $app->location = $validated['location']
                            ? strtoupper(trim($validated['location']))
                            : null;

        $app->save();

        return redirect('approver')->with('status', 'Approver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req)
    {
        $app = approver::findOrFail($req->id);
        $name = $app->name;
        $app->delete();

        return redirect('approver')->with('status', $name . ' deleted successfully');
    }

    /**
     * ✅ TEMPORARY WORKAROUND METHOD
     * This fixes company + department mapping issues
     * caused by spacing / case inconsistencies.
     *
     * This is the method your dropdown / AJAX should call.
     */
    public static function getApprovers($dept, $company, $location = null)
    {
        $dept    = strtoupper(trim($dept));
        $company = strtoupper(trim($company));

        return approver::where(function ($query) use ($dept) {
                $query->whereRaw('UPPER(TRIM(dept)) = ?', [$dept])
                      ->orWhere('dept', 'ALL');
            })
            ->where(function ($query) use ($company) {
                $query->whereRaw('UPPER(TRIM(company)) = ?', [$company])
                      ->orWhere('company', 'ALL');
            })
            ->when($location, function ($query) use ($location) {
                $location = strtoupper(trim($location));
                $query->where(function ($q) use ($location) {
                    $q->whereRaw('UPPER(TRIM(location)) = ?', [$location])
                      ->orWhereNull('location')
                      ->orWhere('location', 'ALL');
                });
            })
            ->get();
    }
}
