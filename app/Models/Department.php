<?php

namespace App\Models;

use App\Traits\HasScopedUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, HasScopedUser, SoftDeletes;

    protected $guarded = ["id", "user_id", "slug"];

    /**
     * Listens to Before Creating / Updating Model events in order to inject an updated slug
     */
    protected static function booting(){

        self::creating( fn($model) => $model->setSlug() );
        self::updating( fn($model) => $model->setSlug() );

    }

    /**
     * Sets a URL friendly slug
     * Removes all non A-Z 0-9 charactors replacing with a single hyphen
     */
    protected function setSlug(){

        $this->slug = preg_replace("/[^0-9a-zA-Z]{1,}/", "-", $this->name );
    }

    /**
     * Items Has Many Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(){
        return $this->hasMany( Item::class );
    }
}
