<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $latestProduct = Product::orderBy('id', 'desc')->first();
            $id = !$latestProduct ? 0 : ($latestProduct->id + 1);
            $model->serial_number = $id;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_code',
        'serial_number',
        'qty',
        'product_name',
        'price',
        'brand_id',
        'supplier_id',
        'warehouse_id',
        'unit_id',
        'sub_category_id'
    ];

    /**
     * Get all images avaialable
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get related brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /**
     * Get related supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Get related warehouse
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    /**
     * Get related unit
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    /**
     * Get related category
     */
    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    /**
     * Get related sub category
     */
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    /**
     * Get specs
     */
    public function specs()
    {
        return $this->belongsToMany(Spec::class, 'products_specs');
    }

    /**
     * Get into ProductSpec pivot table
     */
    public function pivotSpec()
    {
        return $this->hasMany(ProductSpec::class);
    }
}
