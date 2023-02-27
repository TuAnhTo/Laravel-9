<?php

namespace Modules\Admin\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Product::query()->where(['store_id' => $this->getStoreId()])
            ->paginate($perPage);
    }

    /**
     * @param array $data
     * @return Product|null
     */
    public function create(array $data): Product|null
    {
        $data['store_id'] = $this->getStoreId();
        return Product::query()->create($data);
    }

    /**
     * @param Product $product
     * @param array $data
     * @return bool
     */
    public function update(Product $product, array $data): bool
    {
        return $product->whereStoreId($this->getStoreId())->update($data);
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        return Product::query()->whereId($id)->whereStoreId($this->getStoreId())->firstOrFail();
    }

    /**
     * @param Product $product
     * @return bool|null
     */
    public function delete(Product $product): ?bool
    {
        return $product->delete();
    }

    /**
     * @return string
     */
    function getStoreId(): string
    {
        return Auth::guard('api')->user()->getStoreId();
    }
}
