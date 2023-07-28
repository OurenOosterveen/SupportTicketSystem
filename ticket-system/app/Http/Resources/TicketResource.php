<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->format('Y-m-d h:m'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m'),
            'user_id' => $this->user_id,
            'assignee_id' => $this->assignee_id,
            'status_id' => $this->status_id,
            'category_id' => $this->category_id,
        ];
    }
}
