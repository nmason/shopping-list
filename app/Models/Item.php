<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ["id", "user_id"];

    protected static function booting(){

        self::creating( function($model){
            $model->user_id = Auth()->user()
                ? Auth()->user()->id
                : $model->user_id;
        }  );

        static::addGlobalScope('user', function(Builder $builder){
            if ( Auth()->user() )
                $builder->where('items.user_id', '=', Auth()->user()->id );
        });


    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function all($columns = ['*'])
    {
        return static::query()->select("items.*", "departments.name AS department_name")->join('departments', "items.department_id", "departments.id")->get(
            is_array($columns) ? $columns : func_get_args()
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
