<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list_product(){
        return response()->json(
            ProductResource::collection($this->productRepository->list_product())
            , Response::HTTP_OK);
    }
}
