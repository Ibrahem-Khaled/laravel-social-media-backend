<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return
        [
            'id' => $this->id,
            'comment' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'edited' => $this->created_at != $this->updated_at,
            'user' =>
                [
                    'slug' => $this->user->slug,
                    'name' => $this->user->name,
                    'image' => $this->user->profile_picture_url,
                ],
            ];
    }
}
