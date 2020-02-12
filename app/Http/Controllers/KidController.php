<?php

namespace App\Http\Controllers;

use App\Department;
use App\Kid;
use App\User;
use App\Image;
use App\Message;
use App\Illness;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

// Auth::id - gives "id" of the currently logged in user
// Auth::user - gives the entire instance of the currently logged in user
// Auth::check - returns bool if the user is logged in or not

// HOW TO ALLOW ONLY ADMINS ACCESS
//abort_unless(Auth::user()->is_admin(), 403, "STOP! Du är inte admin");

class KidController extends Controller
{
    /**
     * Validation rules for creating and updating a instance of the model
     */
    protected $validation_rules = [
        'first_name'  => 'required|min:2|max:100',
        'last_name'  => 'required|min:2|max:100',
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
        return view('kids/index', [
            'kids' => Kid::orderBy('last_name')->orderBy('first_name')->get(),
            'departments' => Department::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kids/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request from the form against the rules specified in this class
        $validatedData = $request->validate($this->validation_rules);

        $kid = new Kid();
        $kid->department_id = Department::min('id');
        $kid->user_id = Auth::user()->id;
        $kid->first_name = $validatedData['first_name'];
        $kid->last_name = $validatedData['last_name'];

        $kid->save();

        // Goes into the statement if the user has uploaded an image
        if($request->hasFile('file')) {

            // converts the first name and last name of the currently registered kid into a path, and also stores the file beeing uploaded.
            $path = Storage::putFileAs('pictures', $request->file('file'), $this->getFileSlug($kid->first_name . ' ' . $kid->last_name) . '.' . $request->file('file')->guessExtension());

            $image = new Image();
            $image->path = Storage::url($path);
            $image->kid_id = $kid->id;

            $image->save();
        }

        // Redirects the user back to the newly added kid.
        return redirect()->route('kids.show', ['kid' => $kid->id])->with('status', "{$kid->first_name} {$kid->last_name} blev registrerat i {$kid->department->name} avdelningen");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function show(Kid $kid)
    {
        if(Gate::denies("parenting", $kid)) {
            abort(403, "STOP! Det här är inte ditt barn");
        }

        return view('kids.show', [
            'kid' => Kid::findOrFail($kid->id),
            'messages' => Message::where('kid_id', '=', $kid->id)->orderBy('id', 'desc')->take(3)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function edit(Kid $kid)
    {
        if(Gate::denies("parenting", $kid)) {
            abort(403, "STOP! Det här är inte ditt barn");
        }

        return view('kids/edit', [
            'kid' => Kid::findOrfail($kid->id),
            'departments' => Department::all(),
            'today' => Carbon::now()->toDateString(),
            'tomorrow' => Carbon::tomorrow()->toDateString(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kid $kid)
    {
        // validate the request from the form against the rules specified in this class
        $validatedData = $request->validate($this->validation_rules);

        // Conditional to check if admin has changed the id in the form.
        if(is_null($request->input('department_id'))) {
            $kid->department_id = Department::min('id');
        } else {
            $kid->department_id = $request->input('department_id');
        }

        $kid->first_name = $validatedData['first_name'];
        $kid->last_name = $validatedData['last_name'];

        $kid->save();

        if(!is_null($request->input('date_start')) && !is_null($request->input('date_start'))) {

            $illness = new Illness();

            $illness->kid_id = $kid->id;
            $illness->date_start = $request->input('date_start');
            $illness->date_end = $request->input('date_end');

            $illness->save();
        }

        // Goes into the statement if the user has uploaded an image
        if($request->hasFile('file')) {

            // converts the first name and last name of the currently registered kid into a path, and also stores the file beeing uploaded.
            $path = Storage::putFileAs('pictures', $request->file('file'), $this->getFileSlug($kid->first_name . ' ' . $kid->last_name) . '.' . $request->file('file')->guessExtension());

            $image = new Image();
            $image->path = Storage::url($path);
            $image->kid_id = $kid->id;

            $image->save();
        }

        // Redirects the user back to the newly added kid.
        return redirect()->route('kids.show', ['kid' => $kid->id])->with('status', "{$kid->first_name} {$kid->last_name}s uppgifter har blivit uppdaterat");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kid  $kid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kid $kid)
    {
        if(Gate::denies("parenting", $kid)) {
            abort(403, "STOP! Det här är inte ditt barn");
        }

        // removes all messages associated with the current kid
        if(!empty($kid->messages)) {
            foreach($kid->messages as $message) {
                $message->delete();
            }
        }

        // removes all illnesses associated with the current kid
        if(!empty($kid->illnesses)) {
            foreach($kid->illnesses as $illness) {
                $illness->delete();
            }
        }

        // removes image associated with the current kid
        if(!is_null($kid->image)) {
            $kid->image->delete();
        }

        // removes the current kid
        $kid->delete();
        return redirect()->route('kids.index')->with('status', "{$kid->first_name} {$kid->last_name} har blivit avregistrerat ifrån förskolan");
    }

    /**
     * Helper function for getting right name on file
     *
     * @param  \App\Kid  $path
     * @return new slug to be used on the files path
     */
    public function getFileSlug($path)
    {
        $patterns = [];
        $replacements = [];

        $patterns[0] = '/Å/';
        $patterns[1] = '/Ä/';
        $patterns[2] = '/Ö/';
        $patterns[3] = '/å/';
        $patterns[4] = '/ä/';
        $patterns[5] = '/ö/';
        $replacements[0] = 'a';
        $replacements[1] = 'a';
        $replacements[2] = 'o';
        $replacements[3] = 'a';
        $replacements[4] = 'a';
        $replacements[5] = 'o';

        return Str::slug(preg_replace($patterns, $replacements, $path), '-');
    }

    /**
     * Display all the kids of authenticated user
     *
     */
    public function ownKids()
    {
        return view('own-kids', ['kids' => Kid::where('user_id', '=', Auth::user()->id)->get()]);
    }
}
