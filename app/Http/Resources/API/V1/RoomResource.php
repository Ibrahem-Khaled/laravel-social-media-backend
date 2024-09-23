<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);


        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'created_at' => $this->created_at->diffForHumans(),
            'image' => url($this->image),
            'author' => $this->whenLoaded('user', function () {
                return
                [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'slug' => $this->user->slug,
                    'image' => url($this->user->image),
                ];
            }),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                    'slug' => $this->category->slug,
                    'image' => url($this->category->image),
                ];
            }),
            'has_password' => $this->password ? true : false,
            'password' => $this->when($this->password, $this->password),
        ];
    }
}
