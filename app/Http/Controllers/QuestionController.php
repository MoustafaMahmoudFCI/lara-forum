<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['index' , 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index' , compact('questions'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request , [
            'title' => 'required|max:255',
            'body'  => 'required' ,
        ]);
        $data['user_id'] = auth()->id();
        $data['slug'] = str_slug($data['title']);
        Question::create($data);
        return redirect()->route('questions.index')->with('success' , 'Question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $question = Question::with('answers.user')->where('slug' , $slug)->first();
        if ($question) {
            $question->increment('views');
            return view('questions.show' , compact('question'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize("update" , $question);
        return view('questions.edit' , compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, Question $question)
    {
        $this->authorize("update" , $question);

        $data = $this->validate($request , [
            'title' => 'required|max:255',
            'body'  => 'required' ,
        ]);
        $data['slug'] = str_slug($data['title']);
        $question->update($data);
        return redirect()->route('questions.index')->with('success' , 'Question has been Updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete" , $question);

        $question->delete();
        return redirect('/questions')->with('success' , 'Question has been deleted');
    }
}
