<?php

namespace App\Models;

use App\Traits\HasScopedUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory, HasScopedUser;

    protected $guarded = ["id", "user_id"];

    /**
     * Item Lists belong to Items Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(){
        return $this->belongsTo( Item::class );
    }

    /**
     * Modified from Model: Gets all the models for ItemList from the database
     * Includes deparment_name and item name with items / deparments inner joins
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
