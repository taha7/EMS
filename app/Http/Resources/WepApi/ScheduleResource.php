<?php

namespace App\Http\Resources\WepApi;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            [
                'meetings' => $this->meetings->groupBy('company.name')
            ],
            Arr::except(parent::toArray($request), ['meetings'])
        );
    }
}
