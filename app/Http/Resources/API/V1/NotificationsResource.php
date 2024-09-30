<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
            'title' => $this->data['title'],
            'link' => $this->data['link'],
            'sent_at' => $this->created_at->diffForHumans(),
            'read' => $this->read_at ? true : false,
            'read_at' => $this->when($this->read_at, fn() => $this->read_at->diffForHumans()),
        ];
    }
}
