<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;

    protected $table = 'specs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'spec',
        'details',
    ];

    /**
     * Get related products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_specs');
    }
}
