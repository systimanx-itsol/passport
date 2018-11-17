<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Response;
use Validator;
use Auth;
use App\User;

class APIFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::select('feedback.id as feedback_id','u.id as user_id','u.name','u.email','feedback.title','feedback.message')->leftJoin('users as u','u.id','=','feedback.user_id')
        ->where('feedback.Is_Deleted', 0)->orderBy('feedback.id','DESC')->get();

        return response::json(['status' => 1, 'message' => "Success", 'data' => $feedback]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $inputs = file_get_contents("php://input");
        $data = (array) json_decode($inputs);

        $validator = Validator::make($data, [
            'title' => 'required',
            'message' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['Created_by'] = Auth::user()->id;
        if($validator->fails()){
            return response::json(['status' => 0, 'message' => "Validation Error."]);
        }


        $feedback = Feedback::create($data);
        $feedback['user_name'] = Auth::user()->name;
        $feedback['Created_by'] = Auth::user()->name;

        return response::json(['status' => 1, 'message' => "Feedback added Successfully.", 'result' => $feedback->toArray()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = Feedback::find($id);


        if (is_null($feedback)) {
            return response::json(['status' => 0, 'message' => "Feedback not found."]);
        }

        $feedback['user_name'] = Auth::user()->name;
        $feedback['Created_by'] = Auth::user()->name;
        $feedback['Updated_by'] = User::find($feedback['Updated_by'])->name;

        return response::json(['status' => 1, 'message' => "Feedback Data.", 'result' => $feedback->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Feedback $feedback)
    {
        $inputs = file_get_contents("php://input");
        $data = (array) json_decode($inputs);

        $validator = Validator::make($data, [
            'id' => 'required',
            'title' => 'required',
            'message' => 'required'
        ]);


        if($validator->fails()){
            return response::json(['status' => 0, 'message' => "Validation Error."]);
        }


        $feedback->id = $data['id'];
        $feedback->title = $data['title'];
        $feedback->message = $data['message'];
        $feedback->user_id = Auth::user()->id;
        $feedback->Updated_on = date("Y-m-d H:i:s");
        $feedback->Updated_by = Auth::user()->id;
        $feedback->save();

        $feedback['user_name'] = Auth::user()->name;
        $feedback['Created_by'] = Auth::user()->name;
        $feedback['Updated_by'] = User::find($feedback['Updated_by'])->name;
        return response::json(['status' => 1, 'message' => "Feedback updated Successfully.", 'result' => $feedback->toArray()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $inputs = file_get_contents("php://input");
        $data = (array) json_decode($inputs);

        $validator = Validator::make($data, [
            'id' => 'required',
        ]);


        if($validator->fails()){
            return response::json(['status' => 0, 'message' => "Validation Error."]);
        }

        $feedback->Is_Deleted = 1;
        $feedback->Updated_on = date("Y-m-d H:i:s");
        $feedback->Updated_by = Auth::user()->id;
        $feedback->save();

        return response::json(['status' => 1, 'message' => "Feedback deleted Successfully."]);
    }
}
