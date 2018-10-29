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
        $this->_vote($voteQuestions , $question , $vote);
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
        $this->_vote($voteAnswers , $answer , $vote);
    }

    /**
     * [_vote description]
     * @param  [type] $relationship [description]
     * @param  [type] $model        [description]
     * @param  [type] $vote         [description]
     * @return [type]               [description]
     */
    private function _vote($relationship , $model , $vote)
    {
          if ($relationship->where('votable_id' , $model->id)->exists()) {
            $relationship->updateExistingPivot($model , ['vote' => $vote]);
        }else{
            $relationship->attach($model , ['vote' => $vote]);
        }
        $model->load('votes');
        $downVotes = (int) $model->votes()->wherePivot('vote' , -1)->sum('vote');
        $upVotes = (int) $model->votes()->wherePivot('vote' , 1)->sum('vote');

        $model->votes_count = $downVotes + $upVotes;
        $model->save();
    }
}
