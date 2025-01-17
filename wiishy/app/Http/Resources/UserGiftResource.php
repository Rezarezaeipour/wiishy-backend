<?php

namespace App\Http\Resources;

use App\Repositories\likeRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserGiftResource extends JsonResource
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
            'gift_id'=>$this->id,
            'gift_view'=>$this->gift_view,
            'gift_like'=>$this->gift_like,
            'desire_rate'=>$this->desire_rate,
            'created_at'=>$this->created_at,
            'gift_name'=>$this->gift_name,
            'gift_price'=>$this->gift_price,
            'gift_desc'=>$this->gift_desc,
            'gift_url'=>$this->gift_url,
            'islike'=>likeRepository::check($this->id,$request->id),
        ];
    }
}
