<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasFactory;

    /**
     * Override table name
     */
    protected $table = 'products_specs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'spec_id',
        'product_id',
        'value'
    ];

    /**
     * Get related spec
     */
    public function spec()
    {
        return $this->belongsTo(Spec::class, 'spec_id');
    }

    /**
     * Get related product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
