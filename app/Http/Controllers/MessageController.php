<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Validation rules for creating and updating a instance of the model
     */
    protected $validation_rules = [
        'content'  => 'required|max:300',
        'kid_id' => 'required',
    ];

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

        $message = new Message();
        $message->kid_id = $validatedData['kid_id'];
        $message->content = $validatedData['content'];
        $message->save();

        // Redirects the user back to the newly added kid.
        return redirect()->route('kids.show', ['kid' => $message->kid_id])->with('status', "Nytt meddelande");
    }
}
