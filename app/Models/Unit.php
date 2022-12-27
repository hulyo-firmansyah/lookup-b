<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details'
    ];

    /**
     * Get the products for the brands
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
