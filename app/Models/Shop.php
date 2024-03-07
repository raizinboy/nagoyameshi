<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Shop extends Model
{
    use HasFactory, Sortable, Favoriteable;

    protected $casts = [
        'regular_holiday' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Review::class);
    }
   

}
