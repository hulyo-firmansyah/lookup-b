<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_code' => $this->product_code,
            'serial_number' => str_pad(strval($this->serial_number), 8, '0', STR_PAD_LEFT),
            'product_name' => $this->product_name,
            'qty' => $this->qty,
            'price' => $this->price,
            'brand' => new BrandResource($this->brand),
            'supplier' => new SupplierResource($this->supplier),
            'warehouse'  => new WarehouseResource($this->warehouse),
            'unit' => new UnitResource($this->unit),
            // 'category' => new CategoryResource($this->category),
            'sub_category' => new SubCategoryResource($this->whenLoaded('sub_category')),
            'images' => ProductImageResource::collection($this->images),
            'specs' => ProductSpecResource::collection($this->pivotSpec)
        ];
    }
}
