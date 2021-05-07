<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'avg_rating' => $this->averageRating(),
            'total_votes' => $this->totalVotes(),
            'created_date' => $this->created_at
        ];
    }

}
