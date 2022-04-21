<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
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
                $builder->where('item_lists.user_id', '=', Auth()->user()->id );
        });


    }


    public function item(){
        return $this->belongsTo( Item::class );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function all($columns = ['*'])
    {
        return static::query()
            ->select("item_lists.*", "departments.name AS department_name", "items.name")
            ->join('items', "items.id", "item_id")
            ->join('departments', "items.department_id", "departments.id")
            ->get(
            is_array($columns) ? $columns : func_get_args()
        );
    }


}
