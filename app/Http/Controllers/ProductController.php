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

    public function index(){
        return response()->json(
            ProductResource::collection($this->productRepository->all())
            , Response::HTTP_OK);
    }
}
