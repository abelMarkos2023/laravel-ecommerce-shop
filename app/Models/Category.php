<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'parent_id',
        'slug',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '=','active');
    }

    public function scopeStatus(Builder $query, $status): Builder
    {
        return $query->where('status', '=',$status);
    }

    public function scopeFilter(Builder $query, array $filters){

        $query->when($filters['name'] ?? null, function($query, $value) {
             $query->where('name', 'like', '%' . $value . '%');
            })
            ->when($filters['status'] ?? null, function($query, $value) {
                $query->where('status', '=', $value);
            });


        return $query;
    }
}
