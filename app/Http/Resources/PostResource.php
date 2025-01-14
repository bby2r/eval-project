<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->name,
            'title' => $this->title,
            'user_id' => $this->user,
            'created_at' => (new DateTime($this->created_at, config('app.timezone')))->format('Y-m-d H:i:s'),
        ];
    }
}
