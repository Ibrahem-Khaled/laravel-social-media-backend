<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'edited' => $this->created_at != $this->updated_at,
            'created_at' => $this->created_at->diffForHumans(),
            'image' => $this->image ? $this->image_url : null,
            'likes_count' => $this->like,
            'comments_count' => $this->comment,
            'comments' => $this->whenLoaded('comments', function () {
                return 'commentaya';
            }),
            'user' =>
                [
                    'is_followed' => $this->user->isFollowedBy(auth()->user()),
                    'slug' => $this->user->slug,
                    'name' => $this->user->name,
                    'image' => $this->user->profile_picture_url,
                ],

        ];
    }
}
