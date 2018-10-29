<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class VotesController extends Controller
{
	/**
	 * [__construct description]
	 */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * [voteQuestion description]
     * @param  [type] $question [description]
     * @return [type]           [description]
     */
    public function voteQuestion(Question $question)
    {
    	$vote = (int) request()->vote;
    	auth()->user()->voteQuestion($question , $vote);
    	return back();
    }

    /**
     * [voteAnswer description]
     * @param  [type] $answer [description]
     * @return [type]         [description]
     */
    public function voteAnswer(Answer $answer)
    {
    	$vote = (int) request()->vote;
    	auth()->user()->voteAnswer($answer , $vote);
    	return back();
    }
}
