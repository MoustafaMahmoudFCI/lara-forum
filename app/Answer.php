<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable =['body' , 'user_id'];
    public function question()
    {
    	return $this->belongsTo('App\Question');
    }
     public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public static function boot()
    {
    	parent::boot();
    	static::created(function($answer){
    		$answer->question->increment('answers_count');
    	});
        Static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        return $this->bestAnswer() ? 'best-answer' : '';
    }
    public function getIsBestAnswerAttribute()
    {
        return $this->bestAnswer();
    }
    public function bestAnswer()
    {
        return $this->id === $this->question->best_answer_id;
    }

     public function votes()
    {
        return $this->morphToMany('App\User' , 'votable');
    }
}
