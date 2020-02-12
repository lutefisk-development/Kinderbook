<?php

namespace App\Http\Controllers;


use App\Announcement;
use App\Department;
use App\Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Validation rules for creating and updating a instance of the model
     */
    protected $validation_rules = [
        'title'  => 'required|min:5|max:50',
        'content'  => 'required|min:10|max:500',
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

        return view('announcements.index', [
            'departments' => Department::all(),
            'announcements' => Announcement::orderBy('id', 'desc')->paginate(5),
        ]);
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

        $announcement = new Announcement();
        $announcement->department_id = $request->input('department_id');
        $announcement->title = $validatedData['title'];
        $announcement->content = $validatedData['content'];

        $announcement->save();

        // Goes into the statement if the user has uploaded an image
        if($request->hasFile('file')) {

            // converts the first name and last name of the currently registered kid into a path, and also stores the file beeing uploaded.
            $path = Storage::putFileAs('pictures', $request->file('file'), $this->getFileSlug($announcement->title) . '.' . $request->file('file')->guessExtension());

            $image = new Image();
            $image->path = Storage::url($path);
            $image->announcement_id = $announcement->id;

            $image->save();
        }

        // Redirects the user back to the newly added kid.
        return redirect()->route('announcements.index')->with('status', "Nytt meddelande");
    }

    /**
     * Helper function for getting right name on file
     *
     * @param  \App\Announcement  $path
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
}
