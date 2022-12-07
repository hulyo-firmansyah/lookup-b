<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'filename',
        'ext',
        'product_id'
    ];

    /**
     * Get related product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
