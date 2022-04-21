<?php

namespace App\Models;

use App\Traits\HasScopedUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, HasScopedUser;

    protected $guarded = ["id", "user_id"];


    /**
     * Modified from Model: Gets all the models for Items from the database
     * Includes department_name from department join table.
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


    /**
     * Department Belongs to relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
