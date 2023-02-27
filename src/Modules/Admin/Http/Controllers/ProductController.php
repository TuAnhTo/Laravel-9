<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Modules\Admin\Http\Requests\ListRegisterRequest;
use Modules\Admin\Http\Requests\ProductRequest;
use Modules\Admin\Http\Requests\UpdateStatusRequest;
use Modules\Admin\Services\ProductService;
use Modules\Admin\Transformers\ListRegisterResource;
use Modules\Admin\Transformers\ProductResource;
use Modules\Admin\Transformers\ProductsResource;
use Modules\Admin\Transformers\SuccessResource;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param ProductRequest $request
     * @return ProductsResource
     */
    public function index(ProductRequest $request): ProductsResource
    {
        $products = $this->productService->paginateProduct($request);

        return ProductsResource::make($products);
    }

    /**
     * @param ProductRequest $request
     * @return SuccessResource
     */
    public function store(ProductRequest $request): SuccessResource
    {
        $product = $this->productService->store($request->all());

        return SuccessResource::make($product);
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return SuccessResource
     */
    public function update(ProductRequest $request, int $id): SuccessResource
    {
        DB::transaction(function () use ($request, $id) {
            $this->productService->edit($request->all(), $id);
        });

        return SuccessResource::make();
    }

    /**
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = $this->productService->show($id);

        return ProductResource::make($product);
    }

    /**
     * List request register product key
     *
     * @param ListRegisterRequest $request
     * @return ListRegisterResource
     */
    public function listOrderProduct(ListRegisterRequest $request): ListRegisterResource
    {
        $results = $this->productService->listOrderProduct($request);

        return ListRegisterResource::make($results);
    }

    /**
     * Update status
     *
     * @param UpdateStatusRequest $request
     * @param $id
     * @return SuccessResource
     */
    public function changeStatusOrderProduct(UpdateStatusRequest $request, $id): SuccessResource
    {
        $this->productService->updateStatusOrderProduct($request, $id);

        return SuccessResource::make();
    }

    /**
     * @param int $id
     * @return SuccessResource
     */
    public function delete(int $id): SuccessResource
    {
        $this->productService->delete($id);

        return SuccessResource::make();
    }
}
