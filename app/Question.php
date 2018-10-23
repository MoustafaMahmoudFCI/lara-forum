<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $fillable = [
    	'title' , 'body'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getCreatedDateAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
    	if ($this->answers > 0) {
    		if ($this->best_answer_id) {
    			return 'best-answer';
    		}
    		return 'answered';
    	}
    	return 'unanswered';
    }
    
}
