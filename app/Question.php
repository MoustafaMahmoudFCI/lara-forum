<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $fillable = [
    	'title' , 'body' , 'user_id' , 'slug'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }

    public function getCreatedDateAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
    	if ($this->answers_count > 0) {
    		if ($this->best_answer_id) {
    			return 'best-answer';
    		}
    		return 'answered';
    	}
    	return 'unanswered';
    }
    
}
