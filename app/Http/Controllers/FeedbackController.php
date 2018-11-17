<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback_list = Feedback::select('u.name','u.email','feedback.*')->leftJoin('users as u','u.id','=','feedback.user_id')
        ->where('feedback.Is_Deleted', 0)->orderBy('feedback.id','DESC')->get();
        return view('feedback.index', compact('feedback_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'message'=> 'required',
        ]);
        $feedback = new Feedback([
            'user_id' => Auth::user()->id,
            'title' => $request->get('title'),
            'message'=> $request->get('message'),
            'Created_by' => Auth::user()->id
        ]);
        $feedback->save();
        return redirect('/admin/feedback/create')->with('success', 'Feedback has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::find($id);

        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'message'=> 'required',
          ]);
    
        $feedback = Feedback::find($id);
        $feedback->title = $request->get('title');
        $feedback->message = $request->get('message');
        $feedback->Updated_on = date("Y-m-d H:i:s");
        $feedback->Updated_by = Auth::user()->id;
        $feedback->save();

        return redirect('/admin/feedback')->with('success', 'Feedback has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->Is_Deleted = 1;
        $feedback->Updated_on = date("Y-m-d H:i:s");
        $feedback->Updated_by = Auth::user()->id;
        $feedback->save();
        //$feedback->delete();

        return redirect('/admin/feedback')->with('success', 'Feedback has been deleted Successfully');
    }
}
