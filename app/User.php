<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
     public function answers()
    {
        return $this->hasMany('App\Answer');
    } 
    public function favorites()
    {
        return $this->belongsToMany('App\Question' , 'favorites')->withTimeStamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany('App\Question' , 'votable');
    }
    /**
     * [voteAnswers description]
     * @return [type] [description]
     */
    public function voteAnswers()
    {
        return $this->morphedByMany('App\Answer' , 'votable');
    }
    /**
     * [voteQuestion description]
     * @param  Question $question [description]
     * @param  [type]   $vote     [description]
     * @return [type]             [description]
     */
    public function voteQuestion(Question $question , $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('votable_id' , $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question , ['vote' => $vote]);
        }else{
            $voteQuestions->attach($question , ['vote' => $vote]);
        }
        $question->load('votes');
        $downVotes = (int) $question->votes()->wherePivot('vote' , -1)->sum('vote');
        $upVotes = (int) $question->votes()->wherePivot('vote' , 1)->sum('vote');

        $question->votes_count = $downVotes + $upVotes;
        $question->save();
    }

    /**
     * [voteAnswer description]
     * @param  Answer $answer [description]
     * @param  [type] $vote   [description]
     * @return [type]         [description]
     */
    public function voteAnswer(Answer $answer , $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('votable_id' , $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer , ['vote' => $vote]);
        }else{
            $voteAnswers->attach($answer , ['vote' => $vote]);
        }
        $answer->load('votes');
        $downVotes = (int) $answer->votes()->wherePivot('vote' , -1)->sum('vote');
        $upVotes = (int) $answer->votes()->wherePivot('vote' , 1)->sum('vote');

        $answer->votes_count = $downVotes + $upVotes;
        $answer->save();
    }
}
