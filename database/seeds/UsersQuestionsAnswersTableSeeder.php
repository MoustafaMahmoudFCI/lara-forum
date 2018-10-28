<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\User;
use App\Answer;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('users')->delete();
    	\DB::table('questions')->delete();
    	\DB::table('answers')->delete();

         factory(User::class , 3)->create()
        ->each(function($u){ //create random number of question for each user
       		$u->questions()
       		  ->saveMany(factory(Question::class , rand(1,5))->make())
            ->each(function($q){ // create random number of answers for each user
              $q->answers()
                ->saveMany(factory(Answer::class , rand(1,5))->make());
            });
       });
    }
}
