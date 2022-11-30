<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = ['roles' => $this->collection];
        if ($this->resource instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'total' => $this->resource->total(),
                'lastPage' => $this->resource->lastPage(),
                'perPage' => $this->resource->perPage(),
                'currentPage' => $this->resource->currentPage(),
                'nextPageUrl' => $this->resource->nextPageUrl(),
                'previousPageUrl' => $this->resource->previousPageUrl(),
            ];
        }
        return $response;
    }
}
