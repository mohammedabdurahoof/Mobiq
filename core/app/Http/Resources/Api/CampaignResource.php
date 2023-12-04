<?php

namespace App\Http\Resources\Api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id"=> (int) $this->id,
            "title"=> $this->title,
            "subtitle"=> $this->subtitle,
            "image"=> get_attachment_image_by_id($this->image)['img_url'],
            "start_date"=> $this->start_date,
            "end_date"=> $this->end_date,
        ];
    }
}
