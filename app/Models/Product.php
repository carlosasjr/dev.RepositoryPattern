<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ['name', 'url', 'description', 'price', 'category_id'];

    //scopo global anonimo

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByPrice', function (Builder $builder) {
            $builder->orderBy('price', 'desc');
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
