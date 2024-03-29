<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'access_level' => $this->access_level,
            'phone' => $this->phone,
            'email' => $this->email,
            'tasks' => TaskResource::collection($this->tasks),
            'updated_at'=>$this->updated_at,
            'created_at'=>$this->created_at,
        ];
    }
}
