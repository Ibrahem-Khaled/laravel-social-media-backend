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
        // return parent::toArray($request);

        return
        [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->profile_picture_url,
            'following' => $this->following,
            'followers' => $this->followers,
            'following_privacy' => $this->following_privacy ? 'Enabled' : 'Disabled',
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'joined_at' => $this->created_at->format('Y-m-d H:i:s'),
            'verified' => $this->email_verified_at ? true : false,
            'verified_at' => $this->when(
                $this->email_verified_at,
                $this->email_verified_at ? $this->email_verified_at->format('Y-m-d H:i:s') : null
            ),
            'last_login_at' => $this->last_login_at ? $this->last_login_at->format('Y-m-d H:i:s') : null,
            'last_login_ip' => $this->last_login_ip,
            'last_activity_at' => $this->last_activity_at ? $this->last_activity_at->format('Y-m-d H:i:s') : null,
            'last_activity_ip' => $this->last_activity_ip,

        ];
    }
}
