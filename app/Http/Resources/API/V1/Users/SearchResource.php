<?php

namespace App\Http\Resources\API\V1\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
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
            'followers' => $this->when($request->type == 'users', $this->followers),
            'members' => $this->when($request->type == 'rooms', $this->members_count),
            'image' => $request->type == 'users' ? $this->profile_picture_url : $this->image_url,
            'has_password' => $this->when($request->type == 'rooms', $this->password ? true : false),
            'endpoint' => $request->type == 'users' ? route('profile.show', $this->slug) : route('rooms.join', $this->slug),
        ];
    }
}
