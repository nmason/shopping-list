<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     * Sets a global scope so any query using Laravel ORM will inject the user_id=Logged in user on every query
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        if ( Auth()->user() )
                $builder->where($model->getTable().'.user_id', Auth()->user()->id );

    }




}
