<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class FavoriteController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Question $question)
    {
    	$question->favorites()->attach(auth()->id());

    	return back()->with('success' , 'Question Added to favorites list');
    }

    public function destroy(Question $question)
    {
    	$question->favorites()->detach(auth()->id());
    	
    	return back()->with('success' , 'Question deleted from favorites list');
    }

}
