<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted(){
        static:: addGlobalScope('store', function (Builder $builder) {
            $builder->where('store_id', auth()->user()->store_id);
        });
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'store_id',
        'status',
        'slug',
        'created_at',
        'updated_at',
        'is_featured',
        'is_new',
        'is_best_seller',
        'is_top_rated',
        'option',
        'rating',

    ];


}
