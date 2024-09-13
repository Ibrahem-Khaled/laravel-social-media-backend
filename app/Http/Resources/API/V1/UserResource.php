<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);

        return
        [
            'name' => $this->name,
            'email' => $this->email,
            'joined_at' => $this->created_at->format('Y-m-d H:i:s'),
            'verified' => $this->email_verified_at ? true : false,
            'verified_at' => $this->when(
                $this->email_verified_at,
                $this->email_verified_at ? $this->email_verified_at->format('Y-m-d H:i:s') : null
            ),
        ];
    }
}
