<?php

namespace App\Traits;

use App\Scopes\UserScope;

trait HasScopedUser
{

    /**
     * Listens to the before create model event injecting the currenly logged in user id
     * onto the model user_id attribute.  Where a user is logged in, uses existing user_id
     * attribute.
     *
     * This function will over-ride any pre-existing user_id set.
     *
     * Sets a global scope so any query using Laravel ORM will inject the user_id=Logged in user on every query
     *
     */
    protected static function bootHasScopedUser(){

        self::creating( function($model){
            $model->user_id = Auth()->user()
                ? Auth()->user()->id
                : $model->user_id;
        }  );

        static::addGlobalScope( new UserScope() );

    }

    /**
     * Models User Belongs to relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

}
