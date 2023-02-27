<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Request;

class  ProductsResource extends Resource
{
    /**
     * @param $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource = null, int $code = 200, string $message = 'Successful')
    {
        $paginate = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
        ];

        parent::__construct($resource, new MetaPaginationResource($code, $message, null, $paginate));
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->items()
        ];
    }
}
