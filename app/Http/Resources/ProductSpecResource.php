<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSpecResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $spec = new SpecResource($this->spec);
        return [
            'spec' => $spec,
            'value' => [
                'id' => $this->id,
                'value' => $this->value,
            ]
        ];
    }
}
