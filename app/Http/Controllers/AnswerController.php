<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question , Request $request)
    {
        $data = $request->validate(['body' => 'required']);
        $data['user_id'] = \Auth::id();
        $question->answers()->create($data);
        return back()->with('success' , 'Answer submitted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question , Answer $answer)
    {
        $this->authorize('update' , $answer);
        return view('answers.edit' , compact('question' , 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question , Answer $answer)
    {
        $this->authorize('update' , $answer);
        $data = $request->validate(['body' => 'required']);
        $answer->update($data);
        return redirect()->route('questions.show', $question->slug)->with('success' , 'Your Answer Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question , Answer $answer)
    {
        $this->authorize('delete' , $answer);
        $answer->delete();
        return back()->with('success' , 'Answer has been removed');
    }
}
