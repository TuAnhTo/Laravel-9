<?php

namespace Modules\Admin\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

abstract class Resource extends JsonResource
{
    /**
     * @var MetaResource|MetaPaginationResource
     */
    protected MetaPaginationResource|MetaResource $meta;

    /**
     * Resource constructor.
     * @param mixed $resource
     * @param MetaPaginationResource|MetaResource $meta
     */
    public function __construct($resource, MetaResource|MetaPaginationResource $meta)
    {
        $this->meta = $meta;
        parent::__construct($resource);
    }

    /**
     * @return MetaResource|MetaPaginationResource
     */
    public function getMeta(): MetaResource|MetaPaginationResource
    {
        return $this->meta;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'meta' => $this->meta->toArray($request),
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
