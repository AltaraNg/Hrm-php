<?php


use Illuminate\Pagination\LengthAwarePaginator;

function format_date($date, string $format = 'Y-m-d H:m:i')
{
    return $date->format($format);
}


function PaginatedCollection($response, $resource): array|null
{
    if ($resource instanceof LengthAwarePaginator) {
        $response['pagination'] = [
            'total' => $resource->total(),
            'lastPage' => $resource->lastPage(),
            'perPage' => $resource->perPage(),
            'currentPage' => $resource->currentPage(),
            'nextPageUrl' => $resource->nextPageUrl(),
            'previousPageUrl' => $resource->previousPageUrl(),
        ];
    }
    return $response;
}
