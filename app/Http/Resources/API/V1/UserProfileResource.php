<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'bio' => $this->bio,
            'followers' => $this->followers,
            'following' => $this->following,
            'image' => $this->profile_picture_url,
            'posts' => $this->whenLoaded('posts', function () {
                return PostsResource::collection($this->posts);
            }),
        ];
    }
}