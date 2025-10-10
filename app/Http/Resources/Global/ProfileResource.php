<?php

namespace App\Http\Resources\Global;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "role" => $this->role,
            "token"=> $this->token,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
        ];
        if (isset($this->access_token)) {
            $user['token']= $this->access_token;
        }
        return $user;
    }
}
