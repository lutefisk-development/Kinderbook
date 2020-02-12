<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    /**
     * Validation rules for creating and updating a instance of the model
     */
    protected $validation_rules = [
        'name'  => 'required|max:100',
    ];

    /**
     * Defining access to routes.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");
        return view('departments.index', ['departments' => Department::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");
        return view('departments/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");

        // validate the request from the form against the rules specified in this class
        $validatedData = $request->validate($this->validation_rules);

        $department = new Department();
        // A department always belongs to the kindergarten with id 1
        $department->kindergarten_id = 1;
        $department->name = $validatedData['name'];

        $department->save();

        // Redirects the user back to the newly added department.
        return redirect()->route('departments.show', ['department' => $department->id])->with('status', "{$department->name} blev lagt till i förskolan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");
        return view('departments.show', ['department' => Department::findOrFail($department->id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");
        return view('departments.edit', ['department' => Department::findOrFail($department->id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");

        // validate the request from the form against the rules specified in this class
        $validatedData = $request->validate($this->validation_rules);
        $department->name = $validatedData['name'];
        $department->save();

        // Redirects the user back to the newly added kid.
        return redirect()->route('departments.show', ['department' => $department->id])->with('status', "avdelningen {$department->name}s uppgifter har blivit uppdaterat");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");

        // removes all messages associated with the current kid
        if(!empty($department->announcements)) {
            foreach($department->announcements as $announcement) {
                $announcement->delete();
            }
        }

        // removes all illnesses associated with the current kid
        if(!empty($department->kids)) {
            foreach($department->kids as $kid) {
                $department->id === Department::min('id') ? $kid->department_id = Department::min('id') + 1 : $kid->department_id = Department::min('id');
                $kid->save();
            }
        }

        // removes the current kid
        $department->delete();
        return redirect()->route('departments.index')->with('status', "{$department->name} avdelningen finns inte längre på förskolan");
    }
}
