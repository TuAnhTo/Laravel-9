<?php

namespace Modules\Admin\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ProductResource extends Resource
{
    /**
     * SuccessResource constructor.
     * @param null $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource = null, $code = 200, string $message = "Successful")
    {
        parent::__construct($resource, new MetaResource($code, $message, null));
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable
     */
    public function toArray($request): array|Arrayable
    {
        return parent::toArray($request);
    }
}
