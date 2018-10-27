<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

   /**
    * Determine whether the user can mark answer as best answer.
    * @param  User   $user   [description]
    * @param  Answer $answer [description]
    * @return [type]         [description]
    */
    public function bestAnswer(User $user, Answer $answer)
    {
        return $user->id === $answer->question->user_id;
    }

    /**
     * Determine whether the user can create answers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id && $answer->id !== $answer->question->best_answer_id;
    }

    /**
     * Determine whether the user can restore the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function restore(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function forceDelete(User $user, Answer $answer)
    {
        //
    }
}
