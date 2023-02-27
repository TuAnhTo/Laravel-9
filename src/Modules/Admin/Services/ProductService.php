<?php

namespace Modules\Admin\Services;

use App\Exceptions\ApiException;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Admin\Http\Requests\ProductRequest;
use Modules\Admin\Repositories\ProductRepository;

class ProductService
{
    /** @var ProductRepository */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductRequest $request
     * @return LengthAwarePaginator
     */
    public function paginateProduct(ProductRequest $request): LengthAwarePaginator
    {
        $perPage = $request->get('per_page', 10);

        return $this->productRepository->paginate($perPage);
    }

    /**
     * @param array $data
     * @return Product|null
     */
    public function store(array $data): Product|null
    {
        return $this->productRepository->create($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function edit(array $data, int $id): bool
    {
        $product = $this->productRepository->findById($id);

        return $this->productRepository->update($product, $data);
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function show(int $id): ?Product
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw ApiException::notFound('product not found');
        }

        return $product;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw ApiException::notFound('product not found');
        }

        return $this->productRepository->delete($product);
    }
}
