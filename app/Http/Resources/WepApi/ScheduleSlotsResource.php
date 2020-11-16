<?php

namespace App\Http\Resources\WepApi;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ScheduleSlotsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return ScheduleSlotsResource::collection($this->resource);
        }

        return array_merge(
            [
                'meetings' => $this->meetings->groupBy(['company_id', 'conferenceClient.client.company.name'])
            ],
            Arr::except(parent::toArray($request), ['meetings'])
        );
    }
}
